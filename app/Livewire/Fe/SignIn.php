<?php

namespace App\Livewire\Fe;

use Livewire\Component;
use Livewire\Attributes\Layout;

class SignIn extends Component
{
    #[Layout('components.layouts.fe')]
    public function render()
    {
        return view('livewire.fe.sign-in');
    }
}
