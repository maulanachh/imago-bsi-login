<?php

namespace App\Livewire\Master\Rekening;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\rekeningBank;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RekeningForm extends Component
{
    #[Layout('components.layouts.app')]
    public $bank_id;
    public $bank_name;
    public $no_rekening;
    public function resetForm()
    {
        $this->bank_id = null;
        $this->reset();
    }
    public function mount()
    {
        $this->loadData();
    }
    public function create()
    {
        $user = Auth::user();
        $rules = [
            'bank_name' => [
                'required',
                Rule::unique('ms_rekeningbank')->ignore($this->bank_id, 'bank_id')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'no_rekening' => [
                'required',
                Rule::unique('ms_rekeningbank')->ignore($this->no_rekening, 'no_rekening')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $create = rekeningBank::create([
                'bank_name' => $this->bank_name,
                'no_rekening' => $this->no_rekening,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "rekening bank {$this->bank_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $update = rekeningBank::where('bank_id', $this->bank_id)->update([
                'bank_name' => $this->bank_name,
                'no_rekening' => $this->no_rekening,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "rekening bank {$this->bank_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadData()
    {
        $this->bank_id = session('bank_id');
        if ($this->bank_id) {
            $data = rekeningBank::find($this->bank_id);
            if ($data) {
                $this->bank_name = $data->bank_name;
                $this->no_rekening = $data->no_rekening;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['bank_id', 'function']);
        return redirect()->to('/master/rekening/masterbank');
    }
    public function render()
    {
        return view('livewire.master.rekening.rekening-form');
    }
}
