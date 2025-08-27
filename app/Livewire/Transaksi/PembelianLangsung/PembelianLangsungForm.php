<?php

namespace App\Livewire\Transaksi\PembelianLangsung;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\transaksi\billing;
use App\Models\transaksi\billingDetail;
use Illuminate\Support\Carbon;
use App\Models\transaksi\carts;

class PembelianLangsungForm extends Component
{
    public $billing_id;
    public $produk_id;
    public $no_invoice;
    public $user_id;
    public $karyawan_id;
    public $harga_satuan;
    public $stok;
    public $qty;
    public $subtotal_harga;
    public $subtotal_harga_satuan;
    public $tipediskon_id;
    public $diskon = 0;
    public $total_harga;
    public $total_harga_satuan;
    public $data_cart;
    public $data_kolektif;
    public $diskon_billing = 0;
    public $produk = [];
    public $karyawan = [];
    public $tipe_diskon = [];
    public function resetForm()
    {
        $this->billing_id = null;
        $this->reset();
        $this->selectProduk();
        $this->selectKaryawan();
        $this->selectTipeDiskon();
        $this->tableDataCart();
        $this->dataKolektif();
    }
    public function mount()
    {
        // $this->loadData();
        $this->selectProduk();
        $this->selectKaryawan();
        $this->selectTipeDiskon();
        $this->tableDataCart();
        $this->dataKolektif();
        //$this->updatedProdukId($value = null);
    }
    public function selectProduk()
    {
        $this->produk = DB::table('ms_produk')
            ->where('deleted_at', null)
            ->pluck('produk_name', 'produk_id');
    }
    public function selectKaryawan()
    {
        $this->karyawan = DB::table('ms_karyawan')
            ->where('deleted_at', null)
            ->pluck('karyawan_name', 'karyawan_id');
    }
    public function selectTipeDiskon()
    {
        $this->tipe_diskon = DB::table('ms_tipe_diskon')
            ->where('deleted_at', null)
            ->pluck('tipediskon_name', 'tipediskon_id');
    }
    public function updatedProdukId($value)
    {
        // $this->produk_id = null;
        // $this->harga_satuan = null;
        $this->stok = null;
        $this->diskon = null;
        $this->total_harga_satuan = null;
        // Ambil tarif dari fasilitas yang dipilih
        $produk = DB::table('ms_produk')
            ->join('ms_harga_produk', 'ms_produk.produk_id', '=', 'ms_harga_produk.produk_id')
            ->join('ms_stock_produk', 'ms_produk.produk_id', '=', 'ms_stock_produk.produk_id')
            ->where('ms_produk.produk_id', $value)
            ->where('ms_stock_produk.pekerjaan_id', 6)
            ->first();
        $this->harga_satuan = $produk->harga_jual;
        $this->stok = $produk->jumlah_stock;
        $this->tableDataCart();
        $this->dataKolektif();
    }
    public function updatedQty($value)
    {
        $this->subtotal_harga_satuan = $this->harga_satuan * $value;
        $this->tableDataCart();
        $this->dataKolektif();
    }
    // public function updatedDiskon($value)
    // {
    //     $this->total_harga_satuan = $this->subtotal_harga_satuan - ($this->subtotal_harga_satuan * $value / 100);
    // }
    // public function updatedTotalHargaSatuan($value)
    // {
    //     $this->total_harga = $value;
    // }
    public function tableDataCart()
    {
        $auth = Auth::user();
        $this->data_cart = carts::query()
            ->join('ms_produk', 'tr_carts.produk_id', '=', 'ms_produk.produk_id')
            ->where('tr_carts.user_id', $auth->user_id)
            ->select(
                'ms_produk.produk_url',
                'ms_produk.produk_name',
                'tr_carts.harga_satuan',
                'tr_carts.qty',
                'tr_carts.subtotal_harga',
            )
            ->get();
    }
    public function dataKolektif()
    {
        $auth = Auth::user();
        $result = carts::query()
            ->join('ms_produk', 'tr_carts.produk_id', '=', 'ms_produk.produk_id')
            ->where('tr_carts.user_id', $auth->user_id)
            ->select(
                DB::raw('SUM(tr_carts.subtotal_harga) as total_subtotal'),
                DB::raw('SUM(tr_carts.nominal_diskon) as total_diskon'),
                DB::raw('SUM(tr_carts.total_harga) as total_harga')
            )
            ->first();
        $this->data_kolektif = $result ? $result : (object)[
            'total_subtotal' => 0,
            'total_diskon' => 0,
            'total_harga' => 0
        ];
    }
    public function create()
    {
        $this->validate([
            'produk_id' => 'required',
            'qty' => 'required',
            // 'diskon' => 'required',
            // 'total_harga' => 'required',
        ]);
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $subtotal_harga = $this->harga_satuan * $this->qty;
            if ($this->tipediskon_id == null) {
                $tipediskon_id = 1;
                $diskon = 0;
                $nominal_diskon = 0;
                $total_harga = $subtotal_harga;
            } else if ($this->tipediskon_id == 1) {
                $tipediskon_id = $this->tipediskon_id;
                $diskon = $this->diskon;
                $nominal_diskon = $subtotal_harga * $this->diskon / 100;
                $total_harga = $subtotal_harga - ($subtotal_harga * $this->diskon / 100);
            } else if ($this->tipediskon_id == 2) {
                $tipediskon_id = $this->tipediskon_id;
                $diskon = $this->diskon;
                $nominal_diskon = $this->diskon;
                $total_harga = $subtotal_harga - $this->diskon;
            }
            $data = [
                'user_id' => $user->user_id,
                'produk_id' => $this->produk_id,
                'qty' => $this->qty,
                'harga_satuan' => $this->harga_satuan,
                'tipediskon_id' => $tipediskon_id,
                'diskon' => $diskon,
                'nominal_diskon' => $nominal_diskon,
                'subtotal_harga' => $subtotal_harga,
                'total_harga' => $total_harga,
                'created_by' => $user->user_id,
            ];
            $create = carts::create($data);
            DB::commit();
            $this->resetForm();
            $this->tableDataCart();
            $this->dataKolektif();
            $this->dispatch('notifikasi', [
                'type' => 'success',
                'message' => "Produk berhasil ditambahkan.",
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "Terjadi kesalahan: " . $e->getMessage()
            ]);
        }
    }
    public function checkout()
    {
        $auth = Auth::user();
        $referral_id = ($this->karyawan_id && $this->karyawan_id > 0) ? $this->karyawan_id : 0;
        $cartItems = carts::where('user_id', $auth->user_id)->get();

        if ($cartItems->isEmpty()) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "Keranjang belanja kosong.",
            ]);
            return;
        }

        foreach ($cartItems as $item) {
            $totalStok = DB::table('ms_stock_produk')
                ->join('ms_pekerjaan', 'ms_stock_produk.pekerjaan_id', '=', 'ms_pekerjaan.pekerjaan_id')
                ->where('ms_stock_produk.produk_id', $item->produk_id)
                ->sum('ms_stock_produk.jumlah_stock');

            if ($totalStok < $item->qty) {
                $produk = DB::table('ms_produk')->where('produk_id', $item->produk_id)->first();

                $this->dispatch('notifikasi', [
                    'type' => 'error',
                    'message' => "Stok produk {$produk->produk_nama} tidak mencukupi. Dibutuhkan: {$item->qty}, Tersedia: {$totalStok}",
                ]);
                return;
            }
        }


        DB::beginTransaction();

        try {
            // Generate Invoice
            $prefix = "INV-" . Carbon::now()->format('Ymd');
            $lastInvoice = Billing::whereDate('created_at', Carbon::today())
                ->where('no_invoice', 'like', "$prefix%")
                ->orderByDesc('no_invoice')
                ->first();
            $lastNumber = $lastInvoice ? (int) substr($lastInvoice->invoice, -4) : 0;
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $invoiceNumber = $prefix . '-' . $newNumber;

            // Hitung summary
            $summary = [
                'total_subtotal' => $cartItems->sum('subtotal_harga'),
                'total_diskon'   => $cartItems->sum('nominal_diskon'),
                'total_harga'    => $cartItems->sum('total_harga'),
            ];

            // Simpan ke Billing
            $billing = Billing::create([
                'no_invoice'              => $invoiceNumber,
                'user_id'              => $auth->user_id,
                'referral_id'          => $referral_id,
                'subtotal_harga'       => $summary['total_subtotal'],
                'diskon'               => $summary['total_diskon'],
                'diskon_total_billing' => $this->diskon_billing,
                'total_harga'          => $summary['total_harga'],
                'created_at'           => Carbon::now(),
                'updated_at'           => Carbon::now(),
            ]);

            // Simpan ke Billing Detail dan kurangi stok
            foreach ($cartItems as $item) {
                BillingDetail::create([
                    'user_id'        => $auth->user_id,
                    'billing_id'     => $billing->billing_id,
                    'produk_id'      => $item->produk_id,
                    'tipediskon_id'  => $item->tipediskon_id,
                    'qty'            => $item->qty,
                    'harga_satuan'   => $item->harga_satuan,
                    'subtotal_harga' => $item->subtotal_harga,
                    'diskon'         => $item->diskon,
                    'nominal_diskon' => $item->nominal_diskon,
                    'total_harga'    => $item->total_harga,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ]);

                // 🔽 Kurangi stok dari level pekerjaan tertinggi ke terendah
                $sisaQty = $item->qty;
                $stokList = DB::table('ms_stock_produk')
                    ->join('ms_pekerjaan', 'ms_stock_produk.pekerjaan_id', '=', 'ms_pekerjaan.pekerjaan_id')
                    ->where('ms_stock_produk.produk_id', $item->produk_id)
                    ->orderByDesc('ms_pekerjaan.level')
                    ->select('ms_stock_produk.*')
                    ->get();

                foreach ($stokList as $stok) {
                    if ($sisaQty <= 0) break;

                    $ambil = min($sisaQty, $stok->jumlah_stock);

                    DB::table('ms_stock_produk')
                        ->where('stockproduk_id', $stok->stockproduk_id)
                        ->decrement('jumlah_stock', $ambil);

                    $sisaQty -= $ambil;
                }
            }

            // Kosongkan keranjang
            carts::where('user_id', $auth->user_id)->delete();

            DB::commit();

            $this->dispatch('notifikasi', [
                'type' => 'success',
                'message' => "Checkout berhasil!",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "Checkout gagal: " . $e->getMessage(),
            ]);
        }
    }
    public function render()
    {
        return view('livewire.transaksi.pembelian-langsung.pembelian-langsung-form');
    }
}
