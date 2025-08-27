<?php

namespace App\Livewire\Master\BiayaOprasional;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\kategoriProduk;
use App\Models\master\Produk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\master\biayaOperasional;

class BiayaOprasionalForm extends Component
{
    use WithFileUploads;
    #[Layout('components.layouts.app')]
    public $biayaops_id;
    public $tipebiaya_id;
    public $biayaops_name;
    public $nominal_biaya;
    public $tipe_biaya = [];
    public function resetForm()
    {
        $this->biayaops_id = null;
        $this->tipebiaya_id = null;
        $this->reset();
        $this->selectBiaya();
    }
    public function mount()
    {
        $this->loadData();
        $this->selectBiaya();
    }
    public function selectBiaya()
    {
        $this->tipe_biaya = DB::table('ms_tipe_biaya')
            ->where('deleted_at', null)->pluck('tipebiaya_name', 'tipebiaya_id');
    }
    public function create()
    {
        $user = Auth::user();
        $rules = [
            'biayaops_name' => [
                'required',
                Rule::unique('ms_biaya_oprasional')->ignore($this->biayaops_id, 'biayaops_id')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'tipebiaya_id' => ['required'],
            'nominal_biaya' => ['required'],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $create = biayaOperasional::create([
                'tipebiaya_id' => $this->tipebiaya_id,
                'biayaops_name' => $this->biayaops_name,
                'nominal_biaya' => $this->nominal_biaya,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "biaya {$this->biayaops_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $update = biayaOperasional::where('biayaops_id', $this->biayaops_id)->update([
                'tipebiaya_id' => $this->tipebiaya_id,
                'biayaops_name' => $this->biayaops_name,
                'nominal_biaya' => $this->nominal_biaya,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "biaya {$this->biayaops_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadData()
    {
        $this->biayaops_id = session('biayaops_id');
        if ($this->biayaops_id) {
            $data = biayaOperasional::find($this->biayaops_id);
            if ($data) {
                $this->tipebiaya_id = $data->tipebiaya_id;
                $this->biayaops_name = $data->biayaops_name;
                $this->nominal_biaya = $data->nominal_biaya;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['biayaops_id', 'function']);
        return redirect()->to('/master/ops/biayaops');
    }
    public function render()
    {
        return view('livewire.master.biaya-oprasional.biaya-oprasional-form');
    }
}
