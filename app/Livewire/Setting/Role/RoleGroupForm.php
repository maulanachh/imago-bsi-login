<?php

namespace App\Livewire\Setting\Role;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\roleGroup;
use Illuminate\Validation\Rule;

class RoleGroupForm extends Component
{
    #[Layout('components.layouts.app')]
    public $rolegroup;
    public $role_id;



    public function mount()
    {
        $this->loadRoleGroupData();
    }
    public function resetForm()
    {
        $this->role_id = null;
        $this->reset('rolegroup');
    }
    public function createRolegroup()
    {
        $this->validate([
            'rolegroup' => [
                'required',
                'min:4',
                Rule::unique('roles', 'role_name')->whereNull('deleted_at')
            ],
        ]);
        if (session('function') === null) {
            RoleGroup::create([
                'role_name' => $this->rolegroup
            ]);
            session()->flash('success', "Rolegroup {$this->rolegroup} berhasil dibuat.");
            $this->resetForm();
        } else {
            $role = roleGroup::find($this->role_id);
            if ($role) {
                $role->update([
                    'role_name' => $this->rolegroup
                ]);

                session()->flash('success', "Rolegroup {$this->rolegroup} berhasil diupdate.");
                $this->resetForm();
            }
        }
    }

    public function loadRoleGroupData()
    {
        $this->role_id = session('role_id');
        if ($this->role_id) {
            $role = roleGroup::find($this->role_id);
            if ($role) {
                $this->rolegroup = $role->role_name;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        return redirect()->to('/setting/masteruser/rolegroup');
    }
    public function render()
    {
        return view('livewire.setting.role.role-group-form');
    }
}
