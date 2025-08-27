<?php

namespace App\Livewire\Master\Msops\JenisKamar;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JenisKamarIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTablejnskmrLoaded = false;
    public function loadTablejnskmr()
    {
        $this->isTablejnskmrLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createJnsKmr()
    {
        session()->forget(['jnskmr_id', 'function']);

        $this->redirect('/master/ops/jeniskamar/create');
    }
    public function render()
    {
        return view('livewire.master.msops.jenis-kamar.jenis-kamar-index');
    }
}
