<?php

namespace App\Livewire\Setting\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableLoaded = false;
    public function loadTable()
    {
        $this->isTableLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createUser()
    {
        session()->forget(['user_id', 'function']);

        $this->redirect('/setting/masteruser/users/create');
    }
    public function render()
    {
        return view('livewire.setting.user.user-index');
    }
}
