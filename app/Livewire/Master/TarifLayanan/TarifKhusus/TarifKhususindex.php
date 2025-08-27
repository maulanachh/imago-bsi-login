<?php

namespace App\Livewire\Master\TarifLayanan\TarifKhusus;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TarifKhususindex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableTarifLoaded = false;
    public function loadTableTarifKhusus()
    {
        $this->isTableTarifLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createTarifKhusus()
    {
        session()->forget(['trkhusus_id', 'function']);

        $this->redirect('/master/tariflayanan/tarifkhusus/create');
    }
    public function render()
    {
        return view('livewire.master.tarif-layanan.tarif-khusus.tarif-khususindex');
    }
}
