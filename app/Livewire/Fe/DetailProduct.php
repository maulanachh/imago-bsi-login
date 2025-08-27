<?php

namespace App\Livewire\Fe;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\master\Produk;

class DetailProduct extends Component
{
    public $produk_id;
    public $produk;

    #[Layout('components.layouts.fe')]
    public function mount($produk_id)
    {
        $this->produk_id = $produk_id;
        $this->produk = Produk::with('hargaProduk')->findOrFail($produk_id);
    }
    public function render()
    {
        return view('livewire.fe.detail-product');
    }
}
