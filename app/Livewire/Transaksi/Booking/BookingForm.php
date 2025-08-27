<?php

namespace App\Livewire\Transaksi\Booking;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use App\Models\master\customers;
use App\Models\transaksi\rsvLangsung;
use App\Models\transaksi\booking;
use App\Models\master\namaKamar;
use App\Models\transaksi\fasilitasKamar;
use App\Models\master\extraCharge;
use App\Models\transaksi\trExtraCharge;
use App\Models\transaksi\trExtraChargeManual;
use App\Models\transaksi\invoice;
use App\Models\master\tipeDiskon;
use App\Models\master\rekanan;
use App\Models\transaksi\invoiceDP;
use App\Models\transaksi\returPembayaran;
use App\Models\transaksi\menu;

class BookingForm extends Component
{
    #[Layout('components.layouts.app')]
    public $booking_id;
    public $select_cus_id;
    public $cus_id;
    public $cus_name;
    public $cus_address;
    public $cus_phone;
    public $cus_email;
    public $jnsidentity_id;
    public $jenis_identitas = [];
    public $cus_identity_number;
    public $rekanan_id;
    public $rekanan = [];
    public $aslbooking_id;
    public $asal_booking = [];
    public $no_referensi;
    public $jumlah_tamu;
    public $tanggal_checkin;
    public $tanggal_checkout;
    public $tipeinap_id;
    public $tipe_inaps = [];
    public $klskmr_id;
    public $kelas_kamars = [];
    public $kamar_id;
    public $kamars = [];
    public $tarif_kamar;
    public $asal_tarif;
    public $total_malam;
    public $total_tarif_kamar;
    //fasilitas
    public $faskmr_id;
    public $fasilitas_kamars = [];
    public $tarif_exc;
    public $qty_fasilitas;
    public $total_fasilitas;
    public $billfaskmr_id;
    public $data_bill_fasilitaskmr = [];
    //menu makanan
    public $fnb_id;
    public $menu = [];
    public $harga_fnb;
    public $qty_fnb;
    public $total_harga_fnb;
    public $billfnb_id;
    public $data_bill_fnb = [];
    //data pembayaran
    public $data_pembayaran_cus_name;
    public $data_pembayaran_cus_address;
    public $data_pembayaran_total_bill_kamar;
    public $data_pajak;
    public $data_pembayaran_subtotal;
    public $data_pembayaran_total_fasilitas;
    public $data_pembayaran_total_fnb;
    public $data_pembayaran_grandtotal;
    public $bayar_id;
    public $jenis_bayar = [];
    public $bank_id;
    public $nama_bank = [];
    public $stts_bill;
    public $tipediskon_id;
    public $tipe_diskons = [];
    public $nilai_diskon;
    public $nominal_diskon;
    public $nominal_diskon_rekanan;
    public $nominal_pembayaran;
    //retur pembayaran lunas
    public $nominal_bayar;
    public $nominal_retur;
    public $data_pembayaran_kamar_fasilitas;
    public $billtotal_id;
    public $activeTab = 'data_reservasi';
    public function mount()
    {
        $this->loadSelectJenisIdentitas();
        $this->loadSelectRekanan();
        $this->loadAsalBooking();
        $this->loadSelectTipeInap();
        $this->loadSelectKelasKmr();
        $this->loadRSV();
        $this->loadSelectFasilitasKamars();
        $this->tableBillFasilitasKamar();
        $this->loadSelectMenu();
        $this->tableBillFNB();
        $this->loadSelectTipeDiskon();
        $this->hitungDiskon();
        $this->loadJenisBayar();
        $this->loadBank();
        $this->dataPembayaran();
        $this->updatedKlskmrId();
    }
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->tableBillFasilitasKamar();
        $this->tableBillFNB();
        $this->updatedNilaiDiskon();
        $this->dataPembayaran();
        $this->hitungDiskon();
        $this->loadJenisBayar();
        $this->loadBank();
    }
    public function ambilDataCus()
    {
        if (empty($this->select_cus_id)) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "data belum dipilih/data tidak ditemukan"
            ]);
            return;
        }
        $data_cus = customers::where('cus_id', $this->select_cus_id)->first();
        if ($data_cus) {
            $this->cus_id = $this->select_cus_id;
            $this->cus_name = $data_cus->cus_name;
            $this->cus_address = $data_cus->cus_address;
            $this->cus_phone = $data_cus->cus_phone;
            $this->cus_email = $data_cus->cus_email;
            $this->jnsidentity_id = $data_cus->jnsidentity_id;
            $this->cus_identity_number = $data_cus->cus_identity_number;
            $this->dispatch('notifikasi', [
                'type' => 'success',
                'message' => "ambil data customer berhasil"
            ]);
        } else if ($data_cus == null) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "data belum dipilih/data tidak ditemukan"
            ]);
        }
    }
    public function loadSelectJenisIdentitas()
    {
        $this->jenis_identitas = DB::table('ms_jenis_identity')
            ->whereNull('deleted_at')
            ->pluck('jnsidentity_name', 'jnsidentity_id');
    }
    public function loadSelectRekanan()
    {
        $this->rekanan = DB::table('ms_rekanan')
            ->whereNull('deleted_at')
            ->pluck('rekanan_name', 'rekanan_id');
    }
    public function loadAsalBooking()
    {
        $this->asal_booking = DB::table('ms_stts_asalbooking')
            ->whereNull('deleted_at')
            ->pluck('aslbooking_name', 'aslbooking_id');
    }
    public function loadSelectTipeInap()
    {
        $this->tipe_inaps = DB::table('ms_tipe_inap')
            ->whereNull('deleted_at')
            ->pluck('tipeinap_name', 'tipeinap_id');
    }
    public function loadSelectKelasKmr()
    {
        $this->kelas_kamars = DB::table('ms_kelas_kmr')
            ->whereNull('deleted_at')
            ->pluck('klskmr_name', 'klskmr_id');
    }
    public function updatedKlskmrId()
    {
        $rules = [
            'tanggal_checkin' => ['required'],
            'tanggal_checkout' => ['required', 'after_or_equal:tanggal_checkin'],
        ];
        $this->validate($rules);
        $date_checkin = Carbon::createFromFormat('d M, Y', $this->tanggal_checkin)->format('Y-m-d');
        $this->kamars = DB::table('ms_kamar')
            ->where('ms_kamar.klskmr_id', $this->klskmr_id)
            ->where('ms_kamar.deleted_at', null)
            ->whereIn('ms_kamar.sttskmr_id', [1, 2, 3, 4])
            ->whereNotIn('ms_kamar.kamar_id', function ($query) use ($date_checkin) {
                $query->select('kamar_id')
                    ->from('tr_booking_kmr')
                    ->where('tanggal_checkin', '<=', $date_checkin)
                    ->where('tanggal_checkout', '>=', $date_checkin)
                    ->whereNull('rsv_id');;
            })
            ->whereNotIn('ms_kamar.kamar_id', function ($query) use ($date_checkin) {
                $query->select('kamar_id')
                    ->from('tr_reservasi_kmr')
                    ->where('tanggal_checkin', '<=', $date_checkin)
                    ->where('tanggal_checkout', '>=', $date_checkin)
                    ->whereNotIn('sttsrsv_id', [2, 4, 6]);
            })
            ->orWhere(function ($subQuery) {
                $subQuery->whereExists(function ($innerQuery) {
                    $innerQuery->select(DB::raw(1))
                        ->from('tr_booking_kmr')
                        ->whereColumn('tr_booking_kmr.kamar_id', 'ms_kamar.kamar_id')
                        ->where('tr_booking_kmr.booking_id', $this->booking_id);
                });
            })
            ->pluck('ms_kamar.kamar_name', 'ms_kamar.kamar_id');
    }
    public function updatedKamarId()
    {
        $this->hitungTarifKamar();
    }
    public function hitungTarifKamar()
    {
        $rules = [
            'rekanan_id' => ['required'],
            'tanggal_checkin' => ['required'],
            'tanggal_checkout' => ['required', 'after_or_equal:tanggal_checkin'],
            'tipeinap_id' => ['required'],
            'klskmr_id' => ['required'],
            'kamar_id' => ['required'],
        ];
        $this->validate($rules);
        $data_kamar = DB::table('ms_kamar')
            ->whereNull('deleted_at')
            ->where('kamar_id', $this->kamar_id)
            ->first();
        $date_checkin = Carbon::createFromFormat('d M, Y', $this->tanggal_checkin)->format('Y-m-d');
        $date_checkout = Carbon::createFromFormat('d M, Y', $this->tanggal_checkout)->format('Y-m-d');
        $data_tarif_kamar_khusus = DB::table('ms_tarif_khusus_kmr')
            ->where('klskmr_id', $data_kamar->klskmr_id)
            ->whereNull('deleted_at')
            ->where(function ($query) use ($date_checkin) {
                $query->where('tanggal_awal', '<=', $date_checkin)
                    ->where('tanggal_akhir', '>=', $date_checkin);
            })
            ->first();
        if ($data_tarif_kamar_khusus) {
            if ($this->tipeinap_id == 1) {
                $tarif_kamar = $data_tarif_kamar_khusus->trkhusus_fullday;
                $asal_tarif_kamar = 'Tarif Khusus';
            } else {
                $tarif_kamar = $data_tarif_kamar_khusus->trkhusus_halfday;
                $asal_tarif_kamar = 'Tarif Khusus';
            }
        } else {
            $nama_hari = Carbon::parse($date_checkin)->format('l');
            $data_tarif_kamar_harian = DB::table('ms_dailyrate_kmr')
                ->join('ms_days', 'ms_dailyrate_kmr.day_id', '=', 'ms_days.day_id')
                ->where('klskmr_id', $data_kamar->klskmr_id)
                ->whereNull('ms_dailyrate_kmr.deleted_at')
                ->where('ms_days.day_code', $nama_hari)
                ->first();
            if ($data_tarif_kamar_harian) {
                if ($this->tipeinap_id == 1) {
                    $tarif_kamar = $data_tarif_kamar_harian->tarif_harian_fullday;
                    $asal_tarif_kamar = 'Tarif Harian';
                } else {
                    $tarif_kamar = $data_tarif_kamar_harian->tarif_harian_halfday;
                    $asal_tarif_kamar = 'Tarif Harian';
                }
            } else {
                $data_tarif_kamar_dasar =  DB::table('ms_kelas_kmr')
                    ->where('klskmr_id', $data_kamar->klskmr_id)
                    ->whereNull('deleted_at')
                    ->first();
                if ($data_tarif_kamar_dasar) {
                    if ($this->tipeinap_id == 1) {
                        $tarif_kamar = $data_tarif_kamar_dasar->tarif_dasar_fullday;
                        $asal_tarif_kamar = 'Tarif Dasar';
                    } else {
                        $tarif_kamar = $data_tarif_kamar_dasar->tarif_dasar_halfday;
                        $asal_tarif_kamar = 'Tarif Dasar';
                    }
                }
            }
        }
        $checkinTimestamp = strtotime($date_checkin);
        $checkoutTimestamp = strtotime($date_checkout);

        // Menghitung selisih dalam detik
        $selisihDetik = $checkoutTimestamp - $checkinTimestamp;

        // Menghitung selisih dalam hari
        $selisihHari = $selisihDetik / (60 * 60 * 24); // 60 detik * 60 menit * 24 jam
        $selisihHari = (int) $selisihHari;
        $data_penjamin = DB::table('ms_rekanan')
            ->where('rekanan_id', $this->rekanan_id)
            ->whereNull('deleted_at')
            ->first();
        if ($data_penjamin->nominal_diskon !== 0) {
            if ($data_penjamin->tipediskon_id == 2) {
                $this->tarif_kamar = $tarif_kamar - $data_penjamin->nominal_diskon;
                $this->asal_tarif = $asal_tarif_kamar;
            } else {
                $this->tarif_kamar = $tarif_kamar - ($tarif_kamar * $data_penjamin->nominal_diskon / 100);
                $this->asal_tarif = $asal_tarif_kamar;
            }
        } else {
            $this->tarif_kamar = $tarif_kamar;
            $this->asal_tarif = $asal_tarif_kamar;
        }
        $this->total_malam = $selisihHari;
        $this->total_tarif_kamar = $this->tarif_kamar * $selisihHari;
    }
    public function createRSV()
    {

        $user = Auth::user();
        // Aturan validasi
        $rules = [
            'cus_name' => ['required'],
            'cus_address' => ['required'],
            'cus_phone' => ['required'],
            'jnsidentity_id' => ['required'],
            'cus_identity_number' => ['required'],
            'rekanan_id' => ['required'],
            'aslbooking_id' => ['required'],
            'tipeinap_id' => ['required'],
            'klskmr_id' => ['required'],
            'kamar_id' => ['required'],
            'jumlah_tamu' => ['required'],
            'tanggal_checkin' => ['required'],
            'tanggal_checkout' => ['required', 'after_or_equal:tanggal_checkin'],
        ];
        $this->validate($rules);

        // Validasi tipe halfday
        if ($this->tipeinap_id == 2 && $this->tanggal_checkin != $this->tanggal_checkout) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "untuk pemesanan tipe halfday tanggal Check-Out harus sama dengan Check-In."
            ]);
            return;
        }

        $date_checkin = Carbon::createFromFormat('d M, Y', $this->tanggal_checkin)->format('Y-m-d');
        $date_checkout = Carbon::createFromFormat('d M, Y', $this->tanggal_checkout)->format('Y-m-d');

        if (session('function') === null) {
            try {
                DB::beginTransaction();
                if ($this->select_cus_id === null) {
                    $customer_create = customers::create([
                        'cus_name' => $this->cus_name,
                        'cus_address' => $this->cus_address,
                        'cus_phone' => $this->cus_phone,
                        'cus_email' => $this->cus_email,
                        'jnsidentity_id' => $this->jnsidentity_id,
                        'cus_identity_number' => $this->cus_identity_number,
                        'created_by' => $user->user_id,
                    ]);
                    $this->cus_id = $customer_create->cus_id;
                } else {
                    $customer_update = customers::where('cus_id', $this->select_cus_id)->update([
                        'cus_name' => $this->cus_name,
                        'cus_address' => $this->cus_address,
                        'cus_phone' => $this->cus_phone,
                        'cus_email' => $this->cus_email,
                        'jnsidentity_id' => $this->jnsidentity_id,
                        'cus_identity_number' => $this->cus_identity_number,
                        'updated_by' => $user->user_id,
                    ]);
                }
                $rsv_create = booking::create([
                    'cus_id' => $this->cus_id,
                    'kamar_id' => $this->kamar_id,
                    'rekanan_id' => $this->rekanan_id,
                    'aslbooking_id' => $this->aslbooking_id,
                    'no_referensi' => $this->no_referensi,
                    'jumlah_tamu' => $this->jumlah_tamu,
                    'tanggal_checkin' => $date_checkin,
                    'tanggal_checkout' => $date_checkout,
                    'total_malam' => $this->total_malam,
                    'tipeinap_id' => $this->tipeinap_id,
                    'sttsrsv_id' => 5,
                    'tarif_kamar' => $this->tarif_kamar,
                    'asal_tarif' => $this->asal_tarif,
                    'total_tarif_kamar' => $this->total_tarif_kamar,
                    'created_by' => $user->user_id,
                ]);
                $this->booking_id = $rsv_create->booking_id;
                DB::commit();
                $this->updatedKlskmrId();
                $this->updatedKamarId();
                $this->dispatch('notifikasi', [
                    'type' => 'success',
                    'message' => "Reservasi {$this->cus_name} kamar berhasil dibuat.",
                    'booking_id' => $rsv_create->booking_id
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('notifikasi', [
                    'type' => 'error',
                    'message' => "Terjadi kesalahan: " . $e->getMessage()
                ]);
            }
        } else {
            try {
                DB::beginTransaction();
                $customer_update = customers::where('cus_id', $this->cus_id)->update([
                    'cus_name' => $this->cus_name,
                    'cus_address' => $this->cus_address,
                    'cus_phone' => $this->cus_phone,
                    'cus_email' => $this->cus_email,
                    'jnsidentity_id' => $this->jnsidentity_id,
                    'cus_identity_number' => $this->cus_identity_number,
                    'updated_by' => $user->user_id,
                ]);
                $rsv_update = booking::where('booking_id', $this->booking_id)->update([
                    'cus_id' => $this->cus_id,
                    'kamar_id' => $this->kamar_id,
                    'rekanan_id' => $this->rekanan_id,
                    'aslbooking_id' => $this->aslbooking_id,
                    'no_referensi' => $this->no_referensi,
                    'jumlah_tamu' => $this->jumlah_tamu,
                    'tanggal_checkin' => $date_checkin,
                    'tanggal_checkout' => $date_checkout,
                    'total_malam' => $this->total_malam,
                    'tipeinap_id' => $this->tipeinap_id,
                    'sttsrsv_id' => 5,
                    'tarif_kamar' => $this->tarif_kamar,
                    'asal_tarif' => $this->asal_tarif,
                    'total_tarif_kamar' => $this->total_tarif_kamar,
                    'updated_by' => $user->user_id,
                ]);
                DB::commit();
                $this->updatedKlskmrId();
                $this->updatedKamarId();
                $this->dispatch('notifikasi', [
                    'type' => 'success',
                    'message' => "Reservasi {$this->cus_name} kamar berhasil diupdate.",
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('notifikasi', [
                    'type' => 'error',
                    'message' => "Terjadi kesalahan: " . $e->getMessage()
                ]);
            }
        }
    }
    public function loadRSV()
    {
        $this->booking_id = session('booking_id');
        $this->cus_id = session('cus_id');
        if ($this->booking_id) {
            $data_RSV = booking::find($this->booking_id);
            if ($data_RSV) {
                $data_customer = customers::find($data_RSV->cus_id);
                $data_kamar = namaKamar::find($data_RSV->kamar_id);
                $tgl_checkin = Carbon::parse($data_RSV->tanggal_checkin)->format('d M, Y');
                $tgl_checkout = Carbon::parse($data_RSV->tanggal_checkout)->format('d M, Y');
                $this->cus_name = $data_customer->cus_name;
                $this->cus_address = $data_customer->cus_address;
                $this->cus_phone = $data_customer->cus_phone;
                $this->cus_email = $data_customer->cus_email;
                $this->jnsidentity_id = $data_customer->jnsidentity_id;
                $this->cus_identity_number = $data_customer->cus_identity_number;
                $this->rekanan_id = $data_RSV->rekanan_id;
                $this->aslbooking_id = $data_RSV->aslbooking_id;
                $this->tipeinap_id = $data_RSV->tipeinap_id;
                $this->jumlah_tamu = $data_RSV->jumlah_tamu;
                $this->tanggal_checkin = $tgl_checkin;
                $this->tanggal_checkout = $tgl_checkout;
                $this->klskmr_id = $data_kamar->klskmr_id;
                $this->updatedKlskmrId();
                $this->kamar_id = $data_RSV->kamar_id;
                $this->updatedKamarId();
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function loadSelectFasilitasKamars()
    {
        $this->fasilitas_kamars = DB::table('ms_fasilitas_kmr')
            ->whereNull('deleted_at')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item->faskmr_id => $item->faskmr_name . ' - Rp. ' . number_format($item->tarif_exc, 0, ',', '.'),
                ];
            });
    }
    public function updatedFaskmrId($value)
    {
        $fasilitas = DB::table('ms_fasilitas_kmr')->where('faskmr_id', $value)->first();
        if ($fasilitas) {
            $this->tarif_exc = $fasilitas->tarif_exc;
            $this->calculateTotal();
        }
        $this->tableBillFasilitasKamar();
    }
    public function updatedQtyFasilitas()
    {
        $this->calculateTotal();
        $this->tableBillFasilitasKamar();
    }
    public function calculateTotal()
    {
        if (is_numeric($this->tarif_exc) && is_numeric($this->qty_fasilitas)) {
            $this->total_fasilitas = $this->tarif_exc * $this->qty_fasilitas;
        } else {
            $this->total_fasilitas = 0;
        }
        $this->tableBillFasilitasKamar();
    }
    public function createBillFasilitaskamar()
    {
        $user = Auth::user();
        $rules = [
            'faskmr_id' => ['required'],
            'tarif_exc' => ['required'],
            'qty_fasilitas' => ['required'],
            'total_fasilitas' => ['required'],
        ];
        $this->validate($rules);
        if (!$this->booking_id) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "ID reservasi tidak ditemukan, simpan data reservasi dahulu"
            ]);
        }
        try {
            DB::beginTransaction();
            $bill_fasilitas = fasilitasKamar::create([
                'booking_id' => $this->booking_id,
                'faskmr_id' => $this->faskmr_id,
                'tarif_satuan' => $this->tarif_exc,
                'qty' => $this->qty_fasilitas,
                'tarif_total' => $this->total_fasilitas,
                'created_by' => $user->user_id,
            ]);
            DB::commit();
            $this->tableBillFasilitaskamar();
            $this->tableBillFNB();
            $nama_fasilitas = DB::table('ms_fasilitas_kmr')
                ->whereNull('deleted_at')
                ->where('faskmr_id', $this->faskmr_id)
                ->first();
            $this->dispatch('notifikasi', [
                'type' => 'success',
                'message' => "fasilitas {$nama_fasilitas->faskmr_name} berhasil ditambahkan.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "Terjadi kesalahan: " . $e->getMessage()
            ]);
        }
    }
    public function askDelete($billfaskmr_id)
    {
        $this->billfaskmr_id = $billfaskmr_id;
        $this->dispatch('openDeleteModal', [
            'rowId' => $this->billfaskmr_id
        ]);
    }
    public function confirmDeleteBillFasilitas($rowId)
    {
        $user = Auth::user();
        $this->billfaskmr_id = $rowId;
        try {
            DB::beginTransaction();
            $data_bill_fasilitas = fasilitasKamar::find($this->billfaskmr_id);
            $delete_data = $data_bill_fasilitas->delete();
            if ($delete_data) {
                $data_bill_fasilitas->update([
                    'deleted_by' => $user->user_id
                ]);
            }
            DB::commit();
            $this->tableBillFasilitaskamar();
            $this->tableBillFNB();
            $this->dispatch('notifikasi', [
                'type' => 'success',
                'message' => "data berhasil dihapus.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "Terjadi kesalahan: " . $e->getMessage()
            ]);
        }
    }
    public function tableBillFasilitasKamar()
    {
        $this->data_bill_fasilitaskmr = fasilitasKamar::query()
            ->join('ms_fasilitas_kmr', 'tr_bill_fasilitas_kmr.faskmr_id', '=', 'ms_fasilitas_kmr.faskmr_id')
            ->where('booking_id', $this->booking_id)
            ->whereNotNull('booking_id')
            ->select(
                'tr_bill_fasilitas_kmr.billfaskmr_id',
                'ms_fasilitas_kmr.faskmr_name as nama_fasilitas',
                'ms_fasilitas_kmr.faskmr_id',
                'tr_bill_fasilitas_kmr.tarif_satuan',
                'tr_bill_fasilitas_kmr.qty',
                'tr_bill_fasilitas_kmr.tarif_total',
            )
            ->get();
    }
    public function loadSelectMenu()
    {
        $this->menu = DB::table('ms_fnb')
            ->whereNull('deleted_at')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item->fnb_id => $item->fnb_name . ' - Rp. ' . number_format($item->harga, 0, ',', '.'),
                ];
            });
    }
    public function updatedFnbId($value)
    {
        $menu = DB::table('ms_fnb')->where('fnb_id', $value)->first();
        if ($menu) {
            $this->harga_fnb = $menu->harga;
            $this->calculateMenuTotal();
        }
        $this->tableBillFNB();
    }
    public function updatedQtyFnb()
    {
        $this->calculateMenuTotal();
        $this->tableBillFNB();
    }
    public function calculateMenuTotal()
    {
        if (is_numeric($this->harga_fnb) && is_numeric($this->qty_fnb)) {
            $this->total_harga_fnb = $this->harga_fnb * $this->qty_fnb;
        } else {
            $this->total_harga_fnb = 0;
        }
        $this->tableBillFNB();
    }
    public function createBillFNB()
    {
        $user = Auth::user();
        $rules = [
            'fnb_id' => ['required'],
            'harga_fnb' => ['required'],
            'qty_fnb' => ['required'],
            'total_harga_fnb' => ['required'],
        ];
        $this->validate($rules);
        if (!$this->booking_id) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "ID reservasi tidak ditemukan, simpan data reservasi dahulu"
            ]);
        }
        try {
            DB::beginTransaction();
            $bill_menu = menu::create([
                'booking_id' => $this->booking_id,
                'fnb_id' => $this->fnb_id,
                'tarif_satuan' => $this->harga_fnb,
                'qty' => $this->qty_fnb,
                'tarif_total' => $this->total_harga_fnb,
                'created_by' => $user->user_id,
            ]);
            DB::commit();
            $this->tableBillFNB();
            $this->tableBillFasilitaskamar();
            $nama_fnb = DB::table('ms_fnb')
                ->whereNull('deleted_at')
                ->where('fnb_id', $this->fnb_id)
                ->first();
            $this->dispatch('notifikasi', [
                'type' => 'success',
                'message' => "menu {$nama_fnb->fnb_name} berhasil ditambahkan.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "Terjadi kesalahan: " . $e->getMessage()
            ]);
        }
    }
    public function askDeleteFNB($billfnb_id)
    {
        $this->billfnb_id = $billfnb_id;
        $this->dispatch('openDeleteModalFNB', [
            'rowId' => $this->billfnb_id
        ]);
    }
    public function confirmDeleteBillFNB($rowId)
    {
        $user = Auth::user();
        $this->billfnb_id = $rowId;
        try {
            DB::beginTransaction();
            $data_bill_FNB = menu::find($this->billfnb_id);
            $delete_data = $data_bill_FNB->delete();
            if ($delete_data) {
                $data_bill_FNB->update([
                    'deleted_by' => $user->user_id
                ]);
            }
            DB::commit();
            $this->tableBillFNB();
            $this->tableBillFasilitaskamar();
            $this->dispatch('notifikasi', [
                'type' => 'success',
                'message' => "data berhasil dihapus.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "Terjadi kesalahan: " . $e->getMessage()
            ]);
        }
    }
    public function tableBillFNB()
    {
        $this->data_bill_fnb = menu::query()
            ->join('ms_fnb', 'tr_bill_fnb.fnb_id', '=', 'ms_fnb.fnb_id')
            ->where('booking_id', $this->booking_id)
            ->whereNotNull('booking_id')
            ->select(
                'tr_bill_fnb.billfnb_id',
                'ms_fnb.fnb_name as nama_fasilitas',
                'ms_fnb.fnb_id',
                'tr_bill_fnb.tarif_satuan',
                'tr_bill_fnb.qty',
                'tr_bill_fnb.tarif_total',
            )
            ->get();
    }
    public function loadSelectTipeDiskon()
    {
        $this->tipe_diskons = DB::table('ms_tipe_diskon')
            ->whereNull('deleted_at')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item->tipediskon_id => $item->tipediskon_name,
                ];
            });
    }
    public function updatedTipediskonId()
    {
        $this->hitungDiskon();
    }
    public function updatedNilaiDiskon()
    {
        $this->hitungDiskon();
    }
    public function hitungDiskon()
    {

        $load_data_rsv = invoiceDP::where('booking_id', $this->booking_id)->first();

        // Set nilai default dari database jika ada
        if ($load_data_rsv && $load_data_rsv->nominal_diskon) {
            $nominal_diskon = $load_data_rsv->nominal_diskon;
        }

        // Jika ada input baru, update nominal diskon
        if ($this->nilai_diskon != null && $this->nilai_diskon != '') {
            if ($this->tipediskon_id == 1) {
                $nominal_diskon = $this->nilai_diskon * $this->data_pembayaran_subtotal / 100;
            } else if ($this->tipediskon_id == 2) {
                $nominal_diskon = $this->nilai_diskon;
            } else {
                $nominal_diskon = $nominal_diskon ?? 0;
            }
        } else {
            $nominal_diskon = $nominal_diskon ?? 0;
        }

        $this->nominal_diskon = $nominal_diskon;
        $this->dataPembayaran();
    }
    public function dataPembayaran()
    {
        //$this->hitungDiskon();

        $user = Auth::user();
        $booking_id = $this->booking_id;
        $load_data_rsv = booking::find($this->booking_id);
        if ($load_data_rsv) {
            $this->stts_bill = $load_data_rsv->sttsrsv_id;
            $load_data_customer = customers::find($load_data_rsv->cus_id);
            $load_data_bill_kamar = DB::table('tr_booking_kmr')
                ->where('booking_id', $load_data_rsv->booking_id)
                ->whereNotNull('booking_id')
                ->where('deleted_at', null)
                ->select('tanggal_checkin', 'tanggal_checkout', 'tarif_kamar', 'total_tarif_kamar') // Menggunakan DB::raw untuk fungsi SUM
                ->first();
            $cek_diskon_rekanan = DB::table('ms_rekanan')
                ->where('rekanan_id', $load_data_rsv->rekanan_id)
                ->where('deleted_at', null)
                ->select('tipediskon_id', 'nominal_diskon') // Menggunakan DB::raw untuk fungsi SUM
                ->first();
            $load_data_bill_fasilitas = DB::table('tr_bill_fasilitas_kmr')
                ->where('booking_id', $load_data_rsv->booking_id)
                ->whereNotNull('booking_id')
                ->where('deleted_at', null)
                ->select(DB::raw('SUM(tarif_total) as total_tarif_bill_fasilitas')) // Menggunakan DB::raw untuk fungsi SUM
                ->first();
            $load_data_bill_fnb = DB::table('tr_bill_fnb')
                ->where('booking_id', $load_data_rsv->booking_id)
                ->whereNotNull('booking_id')
                ->where('deleted_at', null)
                ->select(DB::raw('SUM(tarif_total) as total_tarif_bill_fnb')) // Menggunakan DB::raw untuk fungsi SUM
                ->first();
            $load_pajak = DB::table('ms_pajak')
                ->where('deleted_at', null)
                ->select() // Menggunakan DB::raw untuk fungsi SUM
                ->first('besaran_pajak', 'satuan');
            $checkinTimestamp = strtotime($load_data_bill_kamar->tanggal_checkin);
            $checkoutTimestamp = strtotime($load_data_bill_kamar->tanggal_checkout);

            // Menghitung selisih dalam detik
            $selisihDetik = $checkoutTimestamp - $checkinTimestamp;

            // Menghitung selisih dalam hari
            $selisihHari = $selisihDetik / (60 * 60 * 24); // 60 detik * 60 menit * 24 jam
            $selisihHari = (int) $selisihHari;

            $jumlah_tarif_kamar = $load_data_bill_kamar->total_tarif_kamar;
            $this->data_pembayaran_cus_name = $load_data_customer->cus_name;
            $this->data_pembayaran_cus_address = $load_data_customer->cus_address;
            $this->data_pembayaran_total_bill_kamar = $jumlah_tarif_kamar;
            $this->data_pajak = $load_pajak->besaran_pajak ?? 0;
            $this->data_pembayaran_total_fasilitas = $load_data_bill_fasilitas->total_tarif_bill_fasilitas ?? 0;
            $this->data_pembayaran_total_fnb = $load_data_bill_fnb->total_tarif_bill_fnb ?? 0;
            $this->data_pembayaran_subtotal = $this->data_pembayaran_total_bill_kamar + $this->data_pembayaran_total_fasilitas + $this->data_pembayaran_total_fnb;
            if ($cek_diskon_rekanan->tipediskon_id == 2) {
                $this->nominal_diskon_rekanan = $cek_diskon_rekanan->nominal_diskon;
            } else {
                $this->nominal_diskon_rekanan = ($this->data_pembayaran_total_bill_kamar + $this->data_pembayaran_total_fasilitas) * $cek_diskon_rekanan->nominal_diskon / 100;
            }
            $this->data_pembayaran_kamar_fasilitas = $this->data_pembayaran_total_bill_kamar + $this->data_pembayaran_total_fasilitas - $this->nominal_diskon - $this->nominal_diskon_rekanan;
            $this->data_pembayaran_grandtotal = $this->data_pembayaran_kamar_fasilitas + $this->data_pembayaran_total_fnb + ($this->data_pembayaran_kamar_fasilitas * $load_pajak->besaran_pajak / 100);
        }
    }
    public function loadJenisBayar()
    {
        $this->jenis_bayar = DB::table('ms_jenis_bayar')
            ->whereNull('deleted_at')
            ->pluck('bayar_name', 'bayar_id');
    }
    public function loadBank()
    {
        $this->nama_bank = DB::table('ms_rekeningbank')
            ->whereNull('deleted_at')
            ->pluck('bank_name', 'bank_id');
    }
    public function checkoutBill()
    {
        $user = Auth::user();
        if (!$this->booking_id) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "data reservasi tidak ditemukan"
            ]);
        }
        $rules = [
            'bayar_id' => ['required'],
            'nominal_pembayaran' => ['required'],
            'bank_id' => ['required_if:bayar_id,2,3,4'], // akan required jika bayar_id = 2,3,4
        ];
        $this->validate($rules);
        if ($this->bayar_id == 5 && $this->rekanan_id == 1) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "jenis pembayaran rekanan tidak bisa digunakan untuk rekanan umum, silahkan update data pendaftaran"
            ]);
            return;
        }
        try {
            DB::beginTransaction();

            // Update status di reservasi
            if (booking::where('booking_id', $this->booking_id)->exists()) {
                booking::where('booking_id', $this->booking_id)
                    ->update([
                        'sttsrsv_id' => '1',
                        'updated_by' => $user->user_id
                    ]);
            }
            // Update status di tabel fasilitas jika ada data
            if (fasilitasKamar::where('booking_id', $this->booking_id)->exists()) {
                fasilitasKamar::where('booking_id', $this->booking_id)
                    ->update([
                        'sttsbill_id' => '3',
                        'updated_by' => $user->user_id
                    ]);
            }
            if (menu::where('booking_id', $this->booking_id)->exists()) {
                menu::where('booking_id', $this->booking_id)
                    ->update([
                        'sttsbill_id' => '3',
                        'updated_by' => $user->user_id
                    ]);
            }

            DB::commit();

            $this->dataPembayaran();
            $this->createInvoice();
            $this->dispatch('notifikasi', [
                'type' => 'success',
                'message' => "pembayaran berhasil",
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Tampilkan pesan error
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "Terjadi kesalahan: " . $e->getMessage()
            ]);
        }
    }
    public function createInvoice()
    {
        $user = Auth::user();
        if (!$this->booking_id) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "data reservasi tidak ditemukan"
            ]);
        }
        $this->dataPembayaran();
        $data_reservasi = booking::find($this->booking_id);
        $cek_invoice = DB::table('tr_bill_dp')
            ->where('booking_id', $this->booking_id)
            ->where('deleted_at', null)
            ->first();
        if (!$cek_invoice) {
            try {
                DB::beginTransaction();
                $tanggal_invoice = date('Ymd');
                $invoice_path = "inv/dp/{$tanggal_invoice}/{$this->booking_id}";
                $create_invoice = invoiceDP::create([
                    'no_invoice' => $invoice_path,
                    'booking_id' => $this->booking_id,
                    'total_bill_kmr' => $this->data_pembayaran_total_bill_kamar,
                    'total_bill_fasilitas' => $this->data_pembayaran_total_fasilitas,
                    'total_bill_fnb' => $this->data_pembayaran_total_fnb,
                    'subtotal' => $this->data_pembayaran_subtotal,
                    'tipediskon_id' => $this->tipediskon_id ?? 0,
                    'nominal_diskon' => $this->nominal_diskon ?? 0,
                    'nominal_diskon_rekanan' => $this->nominal_diskon_rekanan ?? 0,
                    'pajak' => $this->data_pajak,
                    'nominal_pajak' => ($this->data_pajak * ($this->data_pembayaran_kamar_fasilitas)) / 100,
                    'grand_total' => $this->data_pembayaran_grandtotal,
                    'nominal_bayar' => $this->nominal_pembayaran,
                    'bayar_id' => $this->bayar_id,
                    'bank_id' => $this->bank_id,
                    'created_by' => $user->user_id,
                    'updated_by' => $user->user_id,
                ]);

                DB::commit();
                $this->dataPembayaran();
                $this->billtotal_id = $create_invoice->billtotal_id;
                $invoice_url = url("/transaksi/reservasi/direct/invoice/dp/{$this->billtotal_id}");
                $this->dispatch('openInvoice', [
                    'url' => $invoice_url,
                ]);
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                $this->dispatch('notifikasi', [
                    'type' => 'error',
                    'message' => "Terjadi kesalahan: " . $e->getMessage()
                ]);
            }
        } else {
            try {
                DB::beginTransaction();
                $tanggal_invoice = date('Ymd');
                $invoice_path = "inv/dp/{$tanggal_invoice}/{$this->booking_id}";
                $update_invoice = invoiceDP::where('billtotal_id', $cek_invoice->billtotal_id)->update([
                    'no_invoice' => $invoice_path,
                    'booking_id' => $this->booking_id,
                    'total_bill_kmr' => $this->data_pembayaran_total_bill_kamar,
                    'total_bill_fasilitas' => $this->data_pembayaran_total_fasilitas,
                    'total_bill_fnb' => $this->data_pembayaran_total_fnb,
                    'subtotal' => $this->data_pembayaran_subtotal,
                    'tipediskon_id' => $this->tipediskon_id ?? 0,
                    'nominal_diskon' => $this->nominal_diskon ?? 0,
                    'nominal_diskon_rekanan' => $this->nominal_diskon_rekanan ?? 0,
                    'pajak' => $this->data_pajak,
                    //'nominal_pajak' => ($this->data_pajak * ($this->data_pembayaran_total_bill_kamar + $this->data_pembayaran_total_fasilitas)) / 100,
                    'nominal_pajak' => ($this->data_pajak * ($this->data_pembayaran_kamar_fasilitas)) / 100,
                    'grand_total' => $this->data_pembayaran_grandtotal,
                    'nominal_bayar' => $this->nominal_pembayaran,
                    'sttsdp_id' => 1,
                    'bayar_id' => $this->bayar_id,
                    'bank_id' => $this->bank_id,
                    'updated_by' => $user->user_id,
                ]);

                DB::commit();
                $this->dataPembayaran();
                $invoice_url = url("/transaksi/reservasi/direct/invoice/dp/{$cek_invoice->billtotal_id}");
                $this->dispatch('openInvoice', [
                    'url' => $invoice_url,
                ]);
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                $this->dispatch('notifikasi', [
                    'type' => 'error',
                    'message' => "Terjadi kesalahan: " . $e->getMessage()
                ]);
            }
        }
    }

    public function batalReservasiAsk()
    {
        $load_data_rsv = invoiceDP::where('booking_id', $this->booking_id)->first();
        if ($load_data_rsv) {
            $this->nominal_bayar = $load_data_rsv->nominal_bayar;
        }
        $this->dispatch('openBatalReservasiModal', [
            'rowId' => $this->billtotal_id
        ]);
    }
    public function ConfirmbatalReservasi()
    {
        $user = Auth::user();

        if (!$this->booking_id) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "data reservasi tidak ditemukan"
            ]);
        }
        $rules = [
            'bayar_id' => ['required'],
            'bank_id' => ['required_if:bayar_id,2,3,4'], // akan required jika bayar_id = 2,3,4
        ];
        $this->validate($rules);
        if ($this->bank_id == '') {
            $bank_id = 0;
        } else {
            $bank_id = $this->bank_id;
        }
        if ($this->nominal_retur == null || $this->nominal_retur == '') {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "nominal retur harus diisi"
            ]);
        } else if ((int)$this->nominal_retur > (int)$this->nominal_bayar) {
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "nominal retur tidak boleh melebihi jumlah yang sudah dibayar!!"
            ]);
        } else {
            try {
                DB::beginTransaction();

                // Update status di reservasi
                if (booking::where('booking_id', $this->booking_id)->exists()) {
                    booking::where('booking_id', $this->booking_id)
                        ->update([
                            'sttsrsv_id' => 6,
                            'updated_by' => $user->user_id
                        ]);
                }
                // Update status di tabel fasilitas jika ada data
                if (fasilitasKamar::where('booking_id', $this->booking_id)->exists()) {
                    fasilitasKamar::where('booking_id', $this->booking_id)
                        ->update([
                            'sttsbill_id' => '5',
                            'updated_by' => $user->user_id
                        ]);
                }
                if (menu::where('booking_id', $this->booking_id)->exists()) {
                    menu::where('booking_id', $this->booking_id)
                        ->update([
                            'sttsbill_id' => '5',
                            'updated_by' => $user->user_id
                        ]);
                }

                if (invoiceDP::where('booking_id', $this->booking_id)->exists()) {
                    invoiceDP::where('booking_id', $this->booking_id)
                        ->update([
                            'sttsbill_id' => '5',
                            'updated_by' => $user->user_id
                        ]);
                }
                $load_data_rsv = invoiceDP::where('booking_id', $this->booking_id)->first();
                if (returPembayaran::where('booking_id', $this->booking_id)->exists()) {
                    returPembayaran::where('booking_id', $this->booking_id)
                        ->update([
                            'no_invoice' => $load_data_rsv->no_invoice,
                            'billtotal_id' => $load_data_rsv->billtotal_id,
                            'booking_id' => $load_data_rsv->booking_id,
                            'total_bill_kmr' => $load_data_rsv->total_bill_kmr,
                            'total_bill_fasilitas' => $load_data_rsv->total_bill_fasilitas,
                            'subtotal' => $load_data_rsv->subtotal,
                            'tipediskon_id' => $load_data_rsv->tipediskon_id ?? 0,
                            'nominal_diskon' => $load_data_rsv->nominal_diskon ?? 0,
                            'nominal_diskon_rekanan' => $this->nominal_diskon_rekanan ?? 0,
                            'pajak' => $load_data_rsv->pajak,
                            'nominal_pajak' => $load_data_rsv->nominal_pajak,
                            'grand_total' => $load_data_rsv->grand_total,
                            'nominal_bayar' => $load_data_rsv->nominal_bayar,
                            'sttsdp_id' => $load_data_rsv->sttsdp_id,
                            'nominal_retur' => $this->nominal_retur,
                            'bayar_id' => $this->bayar_id,
                            'bank_id' => $bank_id,
                            'created_by' => $user->user_id,
                            'updated_by' => $user->user_id,
                        ]);
                } else {
                    $create_retur = returPembayaran::create([
                        'no_invoice' => $load_data_rsv->no_invoice,
                        'billtotal_id' => $load_data_rsv->billtotal_id,
                        'booking_id' => $load_data_rsv->booking_id,
                        'total_bill_kmr' => $load_data_rsv->total_bill_kmr,
                        'total_bill_fasilitas' => $load_data_rsv->total_bill_fasilitas,
                        'subtotal' => $load_data_rsv->subtotal,
                        'tipediskon_id' => $load_data_rsv->tipediskon_id ?? 0,
                        'nominal_diskon' => $load_data_rsv->nominal_diskon ?? 0,
                        'nominal_diskon_rekanan' => $this->nominal_diskon_rekanan ?? 0,
                        'pajak' => $load_data_rsv->pajak,
                        'nominal_pajak' => $load_data_rsv->nominal_pajak,
                        'grand_total' => $load_data_rsv->grand_total,
                        'nominal_bayar' => $load_data_rsv->nominal_bayar,
                        'sttsdp_id' => $load_data_rsv->sttsdp_id,
                        'nominal_retur' => $this->nominal_retur,
                        'bayar_id' => $this->bayar_id,
                        'bank_id' => $bank_id,
                        'created_by' => $user->user_id,
                        'updated_by' => $user->user_id,
                    ]);
                }

                DB::commit();
                $this->dataPembayaran();
                $this->dispatch('notifikasi', [
                    'type' => 'success',
                    'message' => "retur pembayaran berhasil",
                ]);
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                $this->dispatch('notifikasi', [
                    'type' => 'error',
                    'message' => "Terjadi kesalahan: " . $e->getMessage()
                ]);
            }
        }
    }
    public function resetForm()
    {
        $this->booking_id = null;
        $this->cus_id = null;
        $this->reset([
            'cus_name',
            'cus_address',
            'cus_phone',
            'cus_email',
            'jnsidentity_id',
            'cus_identity_number',
            'tipeinap_id',
            'klskmr_id',
            'kamar_id',
            'jumlah_tamu',
            'tanggal_checkin',
            'tanggal_checkout'
        ]);
    }
    public function checkIn()
    {
        $user = Auth::user();
        if (booking::where('booking_id', $this->booking_id)->exists()) {
            try {
                DB::beginTransaction();
                $data_RSV = booking::find($this->booking_id);
                $rsv_create = rsvLangsung::create([
                    'cus_id' => $data_RSV->cus_id,
                    'booking_id' => $this->booking_id,
                    'kamar_id' => $data_RSV->kamar_id,
                    'rekanan_id' => $data_RSV->rekanan_id,
                    'aslbooking_id' => $data_RSV->aslbooking_id,
                    'no_referensi' => $data_RSV->no_referensi,
                    'jumlah_tamu' => $data_RSV->jumlah_tamu,
                    'tanggal_checkin' => $data_RSV->tanggal_checkin,
                    'tanggal_checkout' => $data_RSV->tanggal_checkout,
                    'total_malam' => $data_RSV->total_malam,
                    'tipeinap_id' => $data_RSV->tipeinap_id,
                    'sttsrsv_id' => 3,
                    'tarif_kamar' => $data_RSV->tarif_kamar,
                    'asal_tarif' => $data_RSV->asal_tarif,
                    'total_tarif_kamar' => $data_RSV->total_tarif_kamar,
                    'created_by' => $user->user_id,
                ]);

                // Update status di reservasi
                if (booking::where('booking_id', $this->booking_id)->exists()) {
                    booking::where('booking_id', $this->booking_id)
                        ->update([
                            'rsv_id' => $rsv_create->rsv_id,
                            'sttsrsv_id' => 3,
                            'updated_by' => $user->user_id
                        ]);
                }
                // Update status di tabel fasilitas jika ada data
                if (fasilitasKamar::where('booking_id', $this->booking_id)->exists()) {
                    fasilitasKamar::where('booking_id', $this->booking_id)
                        ->update([
                            'rsv_id' => $rsv_create->rsv_id,
                            'updated_by' => $user->user_id
                        ]);
                }
                if (menu::where('booking_id', $this->booking_id)->exists()) {
                    menu::where('booking_id', $this->booking_id)
                        ->update([
                            'rsv_id' => $rsv_create->rsv_id,
                            'updated_by' => $user->user_id
                        ]);
                }

                if (invoiceDP::where('booking_id', $this->booking_id)->exists()) {
                    invoiceDP::where('booking_id', $this->booking_id)
                        ->update([
                            'rsv_id' => $rsv_create->rsv_id,
                            'updated_by' => $user->user_id
                        ]);
                }

                $data_invoiceDP = invoiceDP::where('booking_id', $this->booking_id)->first();
                $create_invoice = invoice::create([
                    'no_invoice' => $data_invoiceDP->no_invoice,
                    'rsv_id' => $data_invoiceDP->rsv_id,
                    'total_bill_kmr' => $data_invoiceDP->total_bill_kmr,
                    'total_bill_fasilitas' => $data_invoiceDP->total_bill_fasilitas,
                    'total_bill_fnb' => $data_invoiceDP->total_bill_fnb,
                    'total_bill_extracharge' => 0,
                    'total_bill_extracharge_manual' => 0,
                    'subtotal' => $data_invoiceDP->subtotal,
                    'tipediskon_id' => $data_invoiceDP->tipediskon_id ?? 0,
                    'nominal_diskon' => $data_invoiceDP->nominal_diskon ?? 0,
                    'nominal_diskon_rekanan' => $data_invoiceDP->nominal_diskon_rekanan ?? 0,
                    'pajak' => $data_invoiceDP->pajak,
                    'nominal_pajak' => $data_invoiceDP->nominal_pajak,
                    'grand_total' => $data_invoiceDP->grand_total,
                    'nominal_bayar' => $data_invoiceDP->nominal_bayar,
                    'bayar_id' => $data_invoiceDP->bayar_id,
                    'bank_id' => $data_invoiceDP->bank_id,
                    'created_by' => $user->user_id,
                    'updated_by' => $user->user_id,
                ]);
                DB::commit();
                $this->dataPembayaran();
                $this->dispatch('notifikasi', [
                    'type' => 'success',
                    'message' => "check in berhasil",
                ]);
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                $this->dispatch('notifikasi', [
                    'type' => 'error',
                    'message' => "Terjadi kesalahan: " . $e->getMessage()
                ]);
            }
        }
    }
    public function goBack()
    {
        session()->forget(['booking_id', 'cus_id', 'function']);
        return redirect()->to('/transaksi/reservasi/booking');
    }
    public function render()
    {
        return view('livewire.transaksi.booking.booking-form');
    }
}
