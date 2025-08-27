<?php

namespace App\Livewire\Master\Msops\ExtraCharge;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\extraCharge;
use App\Models\master\jenisFnb;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ExtraChargeForm extends Component
{
    #[Layout('components.layouts.app')]
    public $charge_id;
    public $charge_name;
    public $charge_desc;
    public $tarif_charge;
    public function resetForm()
    {
        $this->charge_id = null;
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
            'charge_name' => [
                'required',
                Rule::unique('ms_extra_charge')->ignore($this->charge_id, 'charge_id')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'tarif_charge' => ['required'],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $create = extraCharge::create([
                'charge_name' => $this->charge_name,
                'charge_desc' => $this->charge_desc,
                'tarif_charge' => $this->tarif_charge,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "menu {$this->charge_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $update = extraCharge::where('charge_id', $this->charge_id)->update([
                'charge_name' => $this->charge_name,
                'charge_desc' => $this->charge_desc,
                'tarif_charge' => $this->tarif_charge,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "menu {$this->charge_name}  berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadData()
    {
        $this->charge_id = session('charge_id');
        if ($this->charge_id) {
            $data = extraCharge::find($this->charge_id);
            if ($data) {
                $this->charge_name = $data->charge_name;
                $this->charge_desc = $data->charge_desc;
                $this->tarif_charge = $data->tarif_charge;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['charge_id', 'function']);
        return redirect()->to('/master/ops/extracharge');
    }
    public function render()
    {
        return view('livewire.master.msops.extra-charge.extra-charge-form');
    }
}
