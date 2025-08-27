<?php

namespace App\Livewire\Master\Customers;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\customers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerForm extends Component
{
    public $cus_id;
    public $cus_name;
    public $cus_address;
    public $cus_phone;
    public $cus_email;
    public $jnsidentity_id;
    public $cus_identity_number;
    public $jenis_identitas = [];
    public function resetForm()
    {
        $this->cus_id = null;
        $this->reset();
        $this->loadSelectJenisIdentitas();
    }
    public function mount()
    {
        $this->loadData();
        $this->loadSelectJenisIdentitas();
    }
    public function loadSelectJenisIdentitas()
    {
        $this->jenis_identitas = DB::table('ms_jenis_identity')
            ->whereNull('deleted_at')
            ->pluck('jnsidentity_name', 'jnsidentity_id');
    }
    public function create()
    {
        $user = Auth::user();
        $rules = [
            'cus_name' => [
                'required',
                Rule::unique('ms_customers')->ignore($this->cus_id, 'cus_id')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'cus_identity_number' => [
                'required',
                Rule::unique('ms_customers')->ignore($this->cus_identity_number, 'cus_identity_number')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'cus_address' => ['required'],
            'cus_phone' => ['required'],
            'jnsidentity_id' => ['required'],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $create = customers::create([
                'jnsidentity_id' => $this->jnsidentity_id,
                'cus_name' => $this->cus_name,
                'cus_address' => $this->cus_address,
                'cus_phone' => $this->cus_phone,
                'cus_email' => $this->cus_email,
                'cus_identity_number' => $this->cus_identity_number,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "customer {$this->cus_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $update = customers::where('cus_id', $this->cus_id)->update([
                'jnsidentity_id' => $this->jnsidentity_id,
                'cus_name' => $this->cus_name,
                'cus_address' => $this->cus_address,
                'cus_phone' => $this->cus_phone,
                'cus_email' => $this->cus_email,
                'cus_identity_number' => $this->cus_identity_number,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "customer {$this->cus_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadData()
    {
        $this->cus_id = session('cus_id');
        if ($this->cus_id) {
            $data = customers::find($this->cus_id);
            if ($data) {
                $this->jnsidentity_id = $data->jnsidentity_id;
                $this->cus_name = $data->cus_name;
                $this->cus_address = $data->cus_address;
                $this->cus_phone = $data->cus_phone;
                $this->cus_email = $data->cus_email;
                $this->cus_identity_number = $data->cus_identity_number;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['cus_id', 'function']);
        return redirect()->to('/master/customer/mastercustomer');
    }
    public function render()
    {
        return view('livewire.master.customers.customer-form');
    }
}
