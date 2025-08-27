<?php

namespace App\Livewire\Master\BiayaOprasional;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BiayaOprasionalIndex extends Component
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
        session()->forget(['biayaops_id', 'function']);

        $this->redirect('/master/ops/biayaops/create');
    }
    public function render()
    {
        return view('livewire.master.biaya-oprasional.biaya-oprasional-index');
    }
}
