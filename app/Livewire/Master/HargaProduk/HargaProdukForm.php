<?php

namespace App\Livewire\Master\HargaProduk;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\kategoriProduk;
use App\Models\master\Produk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\master\hargaProduk;

class HargaProdukForm extends Component
{
    use WithFileUploads;
    #[Layout('components.layouts.app')]
    public $hrgproduk_id;
    public $produk_id;
    public $pekerjaan_id;
    public $hpp;
    public $harga_jual;
    public $data_harga_produk;
    public $nama_produk = [];
    public $pekerjaan = [];
    public function resetForm()
    {
        $this->hrgproduk_id = null;
        $this->produk_id = null;
        $this->reset();
        $this->selectProduk();
        $this->selectRole();
        $this->tableHargaProduk();
    }
    public function mount()
    {
        //$this->loadData();
        $this->tableHargaProduk();
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
    public function tableHargaProduk()
    {

        $this->data_harga_produk = hargaProduk::query()
            ->join('ms_pekerjaan', 'ms_harga_produk.pekerjaan_id', '=', 'ms_pekerjaan.pekerjaan_id')
            ->join('ms_produk', 'ms_harga_produk.produk_id', '=', 'ms_produk.produk_id')
            ->where('ms_harga_produk.produk_id', $this->produk_id)
            ->select(
                'ms_harga_produk.hrgproduk_id',
                'ms_pekerjaan.pekerjaan_name',
                'ms_produk.produk_name',
                'ms_harga_produk.hpp',
                'ms_harga_produk.harga_jual',
            )
            ->get();
    }
    public function updatedProdukId()
    {
        $this->tableHargaProduk();
    }
    public function create()
    {

        $user = Auth::user();
        $rules = [
            'produk_id' => ['required'],
            'pekerjaan_id' => ['required'],
            'hpp' => ['required'],
            'harga_jual' => ['required'],
        ];
        $this->validate($rules);
        $isDuplicate = hargaProduk::where('produk_id', $this->produk_id)
            ->where('pekerjaan_id', $this->pekerjaan_id)
            ->exists();
        if ($isDuplicate) {
            $this->dispatch('resetForm', [
                'type' => 'error', // atau 'error' sesuai kebutuhan
                'message' => "harga produk tersebut sudah ada."
            ]);
            return;
        }
        $create = hargaProduk::create([
            'produk_id' => $this->produk_id,
            'pekerjaan_id' => $this->pekerjaan_id,
            'hpp' => $this->hpp,
            'harga_jual' => $this->harga_jual,
            'created_by' => $user->user_id,
        ]);
        $this->dispatch('resetForm', [
            'type' => 'success', // atau 'error' sesuai kebutuhan
            'message' => "Harga produk berhasil ditambahkan."
        ]);
        $this->tableHargaProduk();
    }
    public function askDelete($hrgproduk_id)
    {
        $this->hrgproduk_id = $hrgproduk_id;
        $this->dispatch('openDeleteModal', [
            'rowId' => $this->hrgproduk_id
        ]);
    }
    public function confirmDelete()
    {
        $data = hargaProduk::find($this->hrgproduk_id);
        if ($data) {
            $delete_data = $data->delete();
            $this->tableHargaProduk();
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "data berhasil didelete."
            ]);
        } else {
            $this->tableHargaProduk();
            $this->dispatch('resetForm', [
                'type' => 'error', // atau 'error' sesuai kebutuhan
                'message' => "Ada kesalahan, hubungi admin system."
            ]);
            return;
        }
    }
    public function render()
    {
        return view('livewire.master.harga-produk.harga-produk-form');
    }
}
