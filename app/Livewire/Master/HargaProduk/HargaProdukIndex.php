<?php

namespace App\Livewire\Master\HargaProduk;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HargaProdukIndex extends Component
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
        session()->forget(['produk_id', 'function']);

        $this->redirect('/master/ops/hargaproduk/create');
    }
    public function render()
    {
        return view('livewire.master.harga-produk.harga-produk-index');
    }
}
