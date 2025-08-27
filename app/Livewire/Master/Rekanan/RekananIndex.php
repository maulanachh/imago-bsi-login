<?php

namespace App\Livewire\Master\Rekanan;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RekananIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableLoaded = false;
    public function loadTable()
    {
        $this->isTableLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createRekanan()
    {
        session()->forget(['rekanan_id', 'function']);

        $this->redirect('/master/tariflayanan/masterrekanan/create');
    }
    public function render()
    {
        return view('livewire.master.rekanan.rekanan-index');
    }
}
