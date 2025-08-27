<?php

namespace App\Livewire\Master\Pajak;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PajakIndex extends Component
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
    // public function create()
    // {
    //     session()->forget(['pajak_id', 'function']);

    //     $this->redirect('/master/fnb/create');
    // }
    public function render()
    {
        return view('livewire.master.pajak.pajak-index');
    }
}
