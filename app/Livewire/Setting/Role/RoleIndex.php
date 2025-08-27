<?php

namespace App\Livewire\Setting\Role;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RoleIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableRoleLoaded = false;

    public function loadTableRole()
    {
        $this->isTableRoleLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createRoleGroup()
    {
        session()->forget(['role_id', 'function']);

        $this->redirect('/setting/masteruser/rolegroup/create');
    }
    public function render()
    {
        return view('livewire.setting.role.role-index');
    }
}
