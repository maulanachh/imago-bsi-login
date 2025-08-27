<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Symfony\Component\HttpFoundation\Request;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SettingIndex extends Component
{

    #[Layout('components.layouts.app')]
    public $username;
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function render()
    {
        return view('livewire.setting.setting-index'); 
    }
}
