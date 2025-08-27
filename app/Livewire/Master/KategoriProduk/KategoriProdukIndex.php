<?php

namespace App\Livewire\Master\KategoriProduk;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KategoriProdukIndex extends Component
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
        session()->forget(['katproduk_id', 'function']);

        $this->redirect('/master/ops/kategoriproduk/create');
    }
    public function render()
    {
        return view('livewire.master.kategori-produk.kategori-produk-index');
    }
}
