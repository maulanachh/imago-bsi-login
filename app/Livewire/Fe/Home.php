<?php

namespace App\Livewire\Fe;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\master\Produk;

class Home extends Component
{
    public $produk_name;
    public $deskripsi_produk;
    public $deskripsi_produk_full;
    public $produk_url;
    public $produkList = [];
    #[Layout('components.layouts.fe')]
    public function mount()
    {
        $this->loadProdukUtama(); // Panggil function saja
        $this->loadProdukList();
    }

    private function loadProdukUtama()
    {
        $produk = Produk::where('produk_utama', 1)->first();

        if ($produk) {
            $this->produk_name = $produk->produk_name;
            // 1. Decode HTML entities (dari &lt;p&gt; jadi <p>)
            $decoded = html_entity_decode($produk->about_produk);

            // 2. Hapus tag HTML
            $plainText = strip_tags($decoded);

            // 3. Batasi panjang
            $this->deskripsi_produk = Str::limit($plainText, 220, '...');
            $this->deskripsi_produk_full = $plainText;
            $this->produk_url = $produk->produk_url;
        } else {
            $this->produk_name = 'Produk Utama Tidak Ditemukan';
            $this->deskripsi_produk = 'Deskripsi belum tersedia.';
            $this->produk_url = 'Image belum tersedia.';
        }
    }
    private function loadProdukList()
    {
        $this->produkList = Produk::with('hargaProduk')
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function render()
    {
        return view('livewire.fe.home');
    }
}
