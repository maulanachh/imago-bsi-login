<?php

namespace App\Livewire\Fe;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\master\Produk;

class Product extends Component
{
    public $produk_name;
    public $deskripsi_produk;
    public $deskripsi_produk_full;
    public $produk_url;
    public $produkList = [];
    #[Layout('components.layouts.fe')]
    public function mount()
    {
        $this->loadProdukList();
    }
    private function loadProdukList()
    {
        $this->produkList = Produk::with('hargaProduk')
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function showDetail($productId)
    {
        return redirect()->to('/detailproduct/' . $productId);
    }
    public function render()
    {
        return view('livewire.fe.product');
    }
}
