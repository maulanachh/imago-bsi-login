<?php

namespace App\Livewire\Master\Msops\FasilitasKamar;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class FasilitasKamarIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableFasilitasLoaded = false;
    public function loadTableFasilitas()
    {
        $this->isTableFasilitasLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createFasilitas()
    {
        session()->forget(['faskmr_id', 'function']);

        $this->redirect('/master/ops/fasilitaskamar/create');
    }
    public function render()
    {
        return view('livewire.master.msops.fasilitas-kamar.fasilitas-kamar-index');
    }
}
