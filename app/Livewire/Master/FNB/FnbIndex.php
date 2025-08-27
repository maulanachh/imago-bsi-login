<?php

namespace App\Livewire\Master\FNB;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FnbIndex extends Component
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
    public function create()
    {
        session()->forget(['fnb_id', 'function']);

        $this->redirect('/master/fnb/create');
    }

    public function render()
    {
        return view('livewire.master.f-n-b.fnb-index');
    }
}
