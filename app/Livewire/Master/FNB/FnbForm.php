<?php

namespace App\Livewire\Master\FNB;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\fnb;
use App\Models\master\jenisFnb;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FnbForm extends Component
{
    #[Layout('components.layouts.app')]
    public $fnb_id;
    public $jenisfnb_id;
    public $fnb_name;
    public $stock;
    public $harga;
    public $jenis_fnb = [];
    public function resetForm()
    {
        $this->fnb_id = null;
        $this->reset();
        $this->selectJenisFnb();
    }
    public function mount()
    {
        $this->loadData();
        $this->selectJenisFnb();
    }
    public function selectJenisFnb()
    {
        $this->jenis_fnb = DB::table('ms_jenisfnb')
            ->where('deleted_at', null)->pluck('jenisfnb_name', 'jenisfnb_id');
    }
    public function create()
    {
        $user = Auth::user();
        $rules = [
            'fnb_name' => [
                'required',
                Rule::unique('ms_fnb')->ignore($this->fnb_id, 'fnb_id')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'jenisfnb_id' => ['required'],
            'stock' => ['required'],
            'harga' => ['required'],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $create = fnb::create([
                'jenisfnb_id' => $this->jenisfnb_id,
                'fnb_name' => $this->fnb_name,
                'stock' => $this->stock,
                'harga' => $this->harga,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "menu {$this->fnb_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $update = fnb::where('fnb_id', $this->fnb_id)->update([
                'jenisfnb_id' => $this->jenisfnb_id,
                'fnb_name' => $this->fnb_name,
                'stock' => $this->stock,
                'harga' => $this->harga,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "menu {$this->fnb_name}  berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadData()
    {
        $this->fnb_id = session('fnb_id');
        if ($this->fnb_id) {
            $data = fnb::find($this->fnb_id);
            if ($data) {
                $this->jenisfnb_id = $data->jenisfnb_id;
                $this->fnb_name = $data->fnb_name;
                $this->stock = $data->stock;
                $this->harga = $data->harga;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['fnb_id', 'function']);
        return redirect()->to('/master/fnb/fnbindex');
    }
    public function render()
    {
        return view('livewire.master.f-n-b.fnb-form');
    }
}
