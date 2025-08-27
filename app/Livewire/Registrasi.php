<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\ACL\user;
use Illuminate\Support\Facades\Hash;

class Registrasi extends Component
{
    #[Layout('components.layouts.auth')]

    public $username;
    public $email;
    public $password;
    public $password_confirmation;

    public function register()
    {
        $rules = [
            'username' => 'required|string|max:50',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ];

        $this->validate($rules);
        $user = user::create([
            'user_name'     => $this->username,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
        ]);
        try {
            $user = user::create([
                'user_name'     => $this->username,
                'email'    => $this->email,
                'password' => Hash::make($this->password),
            ]);
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Registrasi gagal: ' . $e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.registrasi');
    }
}
