<?php

namespace App\Livewire\Master\Msops\KelasKamar;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KelasKamarIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableKelaskmrLoaded = false;
    public function loadTableKelaskmr()
    {
        $this->isTableKelaskmrLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createKelaskmr()
    {
        session()->forget(['klskmr_id', 'function']);

        $this->redirect('/master/ops/kelaskamar/create');
    }
    public function render()
    {
        return view('livewire.master.msops.kelas-kamar.kelas-kamar-index');
    }
}
