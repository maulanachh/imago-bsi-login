<?php

namespace App\Livewire\Transaksi\PembelianLangsung;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PembelianLangsungIndex extends Component
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
        session()->forget(['billing_id', 'function']);

        $this->redirect('/transaksi/pembelianlangsung/create');
    }
    public function render()
    {
        return view('livewire.transaksi.pembelian-langsung.pembelian-langsung-index');
    }
}
