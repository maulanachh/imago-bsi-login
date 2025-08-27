<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class AuthLogin extends Component
{
    #[Layout('components.layouts.auth')]

    public $username;
    public $password;
    protected $rules = [
        'username' => 'required',
        'password' => 'required|min:6',
    ];
    protected $listeners = ['logout'];
    public function login()
    {
        $this->validate();
        if (Auth::attempt(['user_name' => $this->username, 'password' => $this->password])) {
            // dd(Auth::user()->user_name);
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Login successful',
                'redirectUrl' => session()->pull('url.intended', '/dashboard')
            ]);
        } else {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Login failed'
            ]);
        }
    }
    public function render()
    {
        return view('livewire.auth-login');
    }
}
