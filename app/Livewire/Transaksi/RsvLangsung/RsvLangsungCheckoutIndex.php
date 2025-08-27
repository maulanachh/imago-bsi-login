<?php

namespace App\Livewire\Transaksi\RsvLangsung;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RsvLangsungCheckoutIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableRsvLoaded = false;
    public function loadTableRSV()
    {
        $this->isTableRsvLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createRSV()
    {
        session()->forget(['rsv_id', 'function']);

        $this->redirect('/transaksi/reservasi/direct/create');
    }
    public function render()
    {
        return view('livewire.transaksi.rsv-langsung.rsv-langsung-checkout-index');
    }
}
