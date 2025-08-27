<?php

namespace App\Livewire\Master\StockProduk;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\master\stockProduk;

class StockProdukForm extends Component
{
    use WithFileUploads;
    #[Layout('components.layouts.app')]
    public $stockproduk_id;
    public $produk_id;
    public $pekerjaan_id;
    public $jumlah_stock;
    public $data_stock_produk;
    public $nama_produk = [];
    public $pekerjaan = [];

    public function resetForm()
    {
        $this->stockproduk_id = null;
        $this->produk_id = null;
        $this->reset();
        $this->selectProduk();
        $this->selectRole();
        $this->tableHargaProduk();
    }

    public function mount()
    {
        //$this->loadData();
        $this->tableStockProduk();
        $this->selectProduk();
        $this->selectRole();
    }
    public function selectProduk()
    {
        $this->nama_produk = DB::table('ms_produk')
            ->where('deleted_at', null)->pluck('produk_name', 'produk_id');
    }
    public function selectRole()
    {
        $this->pekerjaan = DB::table('ms_pekerjaan')
            ->where('deleted_at', null)->pluck('pekerjaan_name', 'pekerjaan_id');
    }
    public function tableStockProduk()
    {

        $this->data_stock_produk = stockProduk::query()
            ->join('ms_pekerjaan', 'ms_stock_produk.pekerjaan_id', '=', 'ms_pekerjaan.pekerjaan_id')
            ->join('ms_produk', 'ms_stock_produk.produk_id', '=', 'ms_produk.produk_id')
            ->where('ms_stock_produk.produk_id', $this->produk_id)
            ->select(
                'ms_stock_produk.stockproduk_id',
                'ms_pekerjaan.pekerjaan_name',
                'ms_produk.produk_name',
                'ms_stock_produk.jumlah_stock',
            )
            ->get();
    }
    public function updatedProdukId()
    {
        $this->tableStockProduk();
    }
    public function create()
    {

        $user = Auth::user();
        $rules = [
            'produk_id' => ['required'],
            'pekerjaan_id' => ['required'],
            'jumlah_stock' => ['required'],
        ];
        $this->validate($rules);
        $isDuplicate = stockProduk::where('produk_id', $this->produk_id)
            ->where('pekerjaan_id', $this->pekerjaan_id)
            ->exists();
        if ($isDuplicate) {
            $this->dispatch('resetForm', [
                'type' => 'error', // atau 'error' sesuai kebutuhan
                'message' => "stock produk tersebut sudah ada."
            ]);
            return;
        }
        $create = stockProduk::create([
            'produk_id' => $this->produk_id,
            'pekerjaan_id' => $this->pekerjaan_id,
            'jumlah_stock' => $this->jumlah_stock,
            'created_by' => $user->user_id,
        ]);
        $this->dispatch('resetForm', [
            'type' => 'success', // atau 'error' sesuai kebutuhan
            'message' => "Stock produk berhasil ditambahkan."
        ]);
        $this->tableStockProduk();
    }
    public function render()
    {
        return view('livewire.master.stock-produk.stock-produk-form');
    }
}
