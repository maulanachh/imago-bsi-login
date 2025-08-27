<?php

namespace App\Livewire\Master\TarifLayanan\TarifKamarHarian;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TarifHarianIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableTarifLoaded = false;
    public function loadTableTarifHarian()
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
    public function createTarifHarian()
    {
        session()->forget(['dailyrate_id', 'function']);

        $this->redirect('/master/tariflayanan/tarifharian/create');
    }
    public function render()
    {
        return view('livewire.master.tarif-layanan.tarif-kamar-harian.tarif-harian-index');
    }
}
