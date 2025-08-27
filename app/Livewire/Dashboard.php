<?php

namespace App\Livewire;

use Livewire\Component;
use Symfony\Component\HttpFoundation\Request;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
            session()->put('feature_id', 1);
            $this->dispatch('updateBreadcrumb', 1);
        } else {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
