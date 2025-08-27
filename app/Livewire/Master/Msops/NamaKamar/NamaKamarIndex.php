<?php

namespace App\Livewire\Master\Msops\NamaKamar;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NamaKamarIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTablekmrLoaded = false;
    public function loadTableKamar()
    {
        $this->isTablekmrLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createKamar()
    {
        session()->forget(['kamar_id', 'function']);

        $this->redirect('/master/ops/namakamar/create');
    }
    public function render()
    {
        return view('livewire.master.msops.nama-kamar.nama-kamar-index');
    }
}
