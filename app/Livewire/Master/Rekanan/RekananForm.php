<?php

namespace App\Livewire\Master\Rekanan;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\tipeDiskon;
use App\Models\master\masterKaryawan;
use App\Models\master\rekanan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RekananForm extends Component
{
    #[Layout('components.layouts.app')]
    public $rekanan_id;
    public $tipediskon_id;
    public $rekanan_name;
    public $rekanan_desc;
    public $rekanan_alamat;
    public $rekanan_phone;
    public $rekanan_pic;
    public $persen_diskon;
    public $nominal_diskon;
    public $diskon_field;
    public $diskon = [];
    public function resetForm()
    {
        $this->rekanan_id = null;
        $this->reset();
        $this->selectDiskon();
    }
    public function mount()
    {
        $this->loadData();
        $this->selectDiskon();
    }
    public function selectDiskon()
    {
        $this->diskon = DB::table('ms_tipe_diskon')
            ->where('deleted_at', null)->pluck('tipediskon_name', 'tipediskon_id');
    }
    // public function updatedDiskonField()
    // {
    //     dd('halo');
    // }
    public function create()
    {
        $user = Auth::user();
        $rules = [
            'tipediskon_id' => ['required'],
            'rekanan_name' => [
                'required',
                Rule::unique('ms_rekanan')->ignore($this->rekanan_id, 'rekanan_id')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'rekanan_alamat' => ['required'],
            'rekanan_phone' => ['required'],
            'diskon_field' => ['required'],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $create = rekanan::create([
                'tipediskon_id' => $this->tipediskon_id,
                'rekanan_name' => $this->rekanan_name,
                'rekanan_alamat' => $this->rekanan_alamat,
                'rekanan_phone' => $this->rekanan_phone,
                'rekanan_pic' => $this->rekanan_pic,
                'rekanan_desc' => $this->rekanan_desc,
                'nominal_diskon' => $this->diskon_field,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "rekanan {$this->rekanan_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $update = rekanan::where('rekanan_id', $this->rekanan_id)->update([
                'tipediskon_id' => $this->tipediskon_id,
                'rekanan_name' => $this->rekanan_name,
                'rekanan_alamat' => $this->rekanan_alamat,
                'rekanan_phone' => $this->rekanan_phone,
                'rekanan_pic' => $this->rekanan_pic,
                'rekanan_desc' => $this->rekanan_desc,
                'nominal_diskon' => $this->diskon_field,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "rekanan {$this->rekanan_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadData()
    {
        $this->rekanan_id = session('rekanan_id');
        if ($this->rekanan_id) {
            $rekanan = rekanan::find($this->rekanan_id);
            if ($rekanan) {
                $this->tipediskon_id = $rekanan->tipediskon_id;
                $this->rekanan_name = $rekanan->rekanan_name;
                $this->rekanan_desc = $rekanan->rekanan_desc;
                $this->rekanan_alamat = $rekanan->rekanan_alamat;
                $this->rekanan_phone = $rekanan->rekanan_phone;
                $this->rekanan_pic = $rekanan->rekanan_pic;
                $this->diskon_field = $rekanan->nominal_diskon;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['rekanan_id', 'function']);
        return redirect()->to('/master/tariflayanan/masterrekanan');
    }
    public function render()
    {
        return view('livewire.master.rekanan.rekanan-form');
    }
}
