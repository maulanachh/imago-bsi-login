<?php

namespace App\Livewire\Transaksi\RsvLangsung;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use App\Models\master\customers;
use App\Models\transaksi\rsvLangsung;
use App\Models\master\namaKamar;
use App\Models\transaksi\fasilitasKamar;
use App\Models\master\extraCharge;
use App\Models\transaksi\trExtraCharge;
use App\Models\transaksi\trExtraChargeManual;
use App\Models\transaksi\invoice;
use App\Models\master\tipeDiskon;

class RsvLangsungForm extends Component
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

    public $rsv_id;




    public $asal_tarif_kamar;



    public $sttsrsv_id;



    public $billextracharge_id;
    public $billextrachargemanual_id;
    public $faskmr_name;

    public $tarif_charge;
    public $tarif_charge_manual;
    public $keterangan_charge;

    public $qty_extracharge;

    public $total_extracharge;

    public $data_bill_extracharge;
    public $data_bill_extracharge_manual;






    public $charge_id;
    public $charge_id_manual;





    public $extra_charges = [];
    public $extra_charges_manual = [];





    public $data_pembayaran_total_extracharge;
    public $data_pembayaran_total_extracharge_manual;











    public function mount()
    {
        $this->loadRSV();
        $this->loadSelectTipeInap();
        $this->loadSelectJenisIdentitas();
        $this->loadSelectFasilitasKamars();
        $this->tableBillFasilitasKamar();
        $this->loadSelectExtraCharge();
        $this->tableBillExtraCharge();
        $this->loadSelectExtraChargeManual();
        $this->loadSelectTipeDiskon();
        $this->tableBillExtraChargeManual();
        $this->dataPembayaran();
        $this->hitungDiskon();
    }
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->tableBillFasilitasKamar();
        $this->tableBillExtraCharge();
        $this->tableBillExtraChargeManual();
        $this->updatedNilaiDiskon();
        $this->dataPembayaran();
        $this->hitungDiskon();
    }
    public function loadSelectTipeInap()
    {
        $this->tipe_inaps = DB::table('ms_tipe_inap')
            ->whereNull('deleted_at')
            ->pluck('tipeinap_name', 'tipeinap_id');
    }
    public function updatedTipeinapId()
    {
        // Reset kamar_id dan kelas_kamars saat tipe inap berubah
        $this->kamar_id = null;
        $this->kelas_kamars = [];

        $now = Carbon::now();

        // Subquery untuk tarif khusus
        $tarifKhususSub = DB::table('ms_tarif_khusus_kmr')
            ->select('klskmr_id', 'trkhusus_halfday', 'trkhusus_fullday')
            ->whereRaw('CURRENT_DATE BETWEEN tanggal_awal AND tanggal_akhir')
            ->orderBy('created_at', 'desc');

        // Subquery untuk tarif harian
        $tarifHarianSub = DB::table('ms_dailyrate_kmr')
            ->select('klskmr_id', 'tarif_harian_halfday', 'tarif_harian_fullday')
            ->whereDate('created_at', '<=', $now)
            ->orderBy('created_at', 'desc');

        // Ambil kelas kamar berdasarkan tipe inap yang dipilih
        $this->kelas_kamars = DB::table('ms_kelas_kmr')
            ->select(
                'ms_kelas_kmr.klskmr_id',
                'ms_kelas_kmr.klskmr_name',
                DB::raw('COALESCE(ms_tarif_khusus_kmr.trkhusus_halfday, ms_dailyrate_kmr.tarif_harian_halfday, ms_kelas_kmr.tarif_dasar_halfday) as tarif_halfday'),
                DB::raw('COALESCE(ms_tarif_khusus_kmr.trkhusus_fullday, ms_dailyrate_kmr.tarif_harian_fullday, ms_kelas_kmr.tarif_dasar_fullday) as tarif_fullday'),
                DB::raw('CASE
                WHEN ms_tarif_khusus_kmr.trkhusus_halfday IS NOT NULL THEN "Tarif Khusus"
                WHEN ms_dailyrate_kmr.tarif_harian_halfday IS NOT NULL THEN "Tarif Harian"
                ELSE "Tarif Dasar"
            END as jenis_tarif_halfday'),
                DB::raw('CASE
                WHEN ms_tarif_khusus_kmr.trkhusus_fullday IS NOT NULL THEN "Tarif Khusus"
                WHEN ms_dailyrate_kmr.tarif_harian_fullday IS NOT NULL THEN "Tarif Harian"
                ELSE "Tarif Dasar"
            END as jenis_tarif_fullday')
            )
            ->leftJoinSub($tarifKhususSub, 'ms_tarif_khusus_kmr', 'ms_kelas_kmr.klskmr_id', '=', 'ms_tarif_khusus_kmr.klskmr_id')
            ->leftJoinSub($tarifHarianSub, 'ms_dailyrate_kmr', 'ms_kelas_kmr.klskmr_id', '=', 'ms_dailyrate_kmr.klskmr_id')
            ->whereNull('ms_kelas_kmr.deleted_at')
            ->get()
            ->mapWithKeys(function ($item) {
                $tarif = $this->tipeinap_id == 1 ? $item->tarif_fullday : $item->tarif_halfday;
                $jenis_tarif = $this->tipeinap_id == 1 ? $item->jenis_tarif_fullday : $item->jenis_tarif_halfday;

                return [
                    $item->klskmr_id => [
                        'name' => $item->klskmr_name,
                        'tarif' => $tarif,
                        'jenis_tarif' => $jenis_tarif,
                        'formatted' => $item->klskmr_name . ' - ' . ($this->tipeinap_id == 1 ? 'Fullday' : 'Halfday') . ': Rp. ' . number_format($tarif, 0, ',', '.') . ' (' . $jenis_tarif . ')'
                    ]
                ];
            });
    }
    public function updatedKlskmrId()
    {
        // Ambil kelas kamar yang dipilih
        $selectedKlsKmr = $this->kelas_kamars[$this->klskmr_id] ?? null;
        // Jika kelas kamar yang dipilih ada, reset kamar_id
        if ($selectedKlsKmr) {
            $this->tarif_kamar = $selectedKlsKmr['tarif'];
            $this->asal_tarif_kamar = $selectedKlsKmr['jenis_tarif'];
            $this->kamar_id = null; // Reset kamar_id

            // Ambil ID reservasi saat ini
            $currentRsvId = $this->rsv_id;

            // Ambil kamar berdasarkan kelas kamar yang dipilih
            $this->kamars = DB::table('ms_kamar')
                ->where('klskmr_id', $this->klskmr_id) // Gunakan klskmr_id yang dipilih
                ->where('deleted_at', null)
                ->where(function ($query) use ($currentRsvId) {
                    $query->whereIn('sttskmr_id', [1, 2]) // Kamar kosong atau siap
                        ->orWhereExists(function ($subQuery) use ($currentRsvId) {
                            $subQuery->select(DB::raw(1))
                                ->from('tr_reservasi_kmr')
                                ->whereColumn('tr_reservasi_kmr.kamar_id', 'ms_kamar.kamar_id')
                                ->where('tr_reservasi_kmr.rsv_id', $currentRsvId);
                        });
                })
                ->pluck('kamar_name', 'kamar_id'); // Ambil nama dan ID kamar
        } else {
            // Jika tidak ada kelas kamar yang dipilih, kosongkan daftar kamar
            $this->kamars = [];
        }
    }
    public function loadSelectJenisIdentitas()
    {
        $this->jenis_identitas = DB::table('ms_jenis_identity')
            ->whereNull('deleted_at')
            ->pluck('jnsidentity_name', 'jnsidentity_id');
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
        // Ambil tarif dari fasilitas yang dipilih
        $fasilitas = DB::table('ms_fasilitas_kmr')->where('faskmr_id', $value)->first();
        if ($fasilitas) {
            $this->tarif_exc = $fasilitas->tarif_exc; // Set tarif satuan
            $this->calculateTotal(); // Hitung total jika qty sudah ada
        }
        $this->tableBillFasilitasKamar();
    }
    public function updatedQtyFasilitas()
    {
        $this->calculateTotal(); // Hitung total setiap kali qty diupdate
        $this->tableBillFasilitasKamar();
    }
    public function calculateTotal()
    {
        // Pastikan tarif_exc dan qty_fasilitas adalah angka
        if (is_numeric($this->tarif_exc) && is_numeric($this->qty_fasilitas)) {
            $this->total_fasilitas = $this->tarif_exc * $this->qty_fasilitas; // Hitung total
        } else {
            $this->total_fasilitas = 0; // Reset total jika ada yang tidak valid
        }
        $this->tableBillFasilitasKamar();
    }

    public function tableBillFasilitasKamar()
    {

        $this->data_bill_fasilitaskmr = fasilitasKamar::query()
            ->join('ms_fasilitas_kmr', 'tr_bill_fasilitas_kmr.faskmr_id', '=', 'ms_fasilitas_kmr.faskmr_id')
            ->where('rsv_id', $this->rsv_id)
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
    public function loadSelectExtraCharge()
    {
        $this->extra_charges = DB::table('ms_extra_charge')
            ->whereNull('deleted_at')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item->charge_id => $item->charge_name . ' - Rp. ' . number_format($item->tarif_charge, 0, ',', '.'),
                ];
            });
    }
    public function updatedChargeId($value)
    {
        // Ambil tarif dari fasilitas yang dipilih
        $item_charge = DB::table('ms_extra_charge')->where('charge_id', $value)->first();
        if ($item_charge) {
            $this->tarif_charge = $item_charge->tarif_charge; // Set tarif satuan
            $this->calculateExtrachargeTotal(); // Hitung total jika qty sudah ada
        }
        $this->tableBillExtraCharge();
    }
    public function updatedQtyExtracharge()
    {
        $this->calculateExtrachargeTotal(); // Hitung total setiap kali qty diupdate
        $this->tableBillExtraCharge();
    }
    public function calculateExtrachargeTotal()
    {
        // Pastikan tarif_exc dan qty_fasilitas adalah angka
        if (is_numeric($this->tarif_charge) && is_numeric($this->qty_extracharge)) {
            $this->total_extracharge = $this->tarif_charge * $this->qty_extracharge; // Hitung total
        } else {
            $this->total_extracharge = 0; // Reset total jika ada yang tidak valid
        }
        $this->tableBillExtraCharge();
    }
    public function tableBillExtraCharge()
    {

        $this->data_bill_extracharge = trExtraCharge::query()
            ->join('ms_extra_charge', 'tr_bill_extracharge_kmr.charge_id', '=', 'ms_extra_charge.charge_id')
            ->where('rsv_id', $this->rsv_id)
            ->select(
                'tr_bill_extracharge_kmr.billextracharge_id',
                'ms_extra_charge.charge_name',
                'ms_extra_charge.charge_id',
                'tr_bill_extracharge_kmr.tarif_satuan',
                'tr_bill_extracharge_kmr.qty',
                'tr_bill_extracharge_kmr.tarif_total',
            )
            ->get();
    }
    public function loadSelectExtraChargeManual()
    {
        $this->extra_charges_manual = DB::table('ms_extra_charge')
            ->whereNull('deleted_at')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item->charge_id => $item->charge_name . ' - Rp. ' . number_format($item->tarif_charge, 0, ',', '.'),
                ];
            });
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
    public function resetForm()
    {
        $this->rsv_id = null;
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

    public function createRSV()
    {
        $user = Auth::user();
        // Aturan validasi
        $rules = [
            'cus_name' => ['required'],
            'jnsidentity_id' => ['required'],
            'cus_identity_number' => ['required'],
            'cus_phone' => ['required'],
            'tipeinap_id' => ['required'],
            'klskmr_id' => ['required'],
            'kamar_id' => ['required'],
            'jumlah_tamu' => ['required'],
            'tanggal_checkin' => ['required'],
            'tanggal_checkout' => ['required'],
        ];
        $this->validate($rules);

        // Validasi tipe halfday
        if ($this->tipeinap_id == 2 && $this->tanggal_checkin != $this->tanggal_checkout) {
            $this->dispatch('showError', "untuk pemesanan tipe halfday tanggal Check-Out harus sama dengan Check-In.");
            return;
        }

        $date_checkin = Carbon::createFromFormat('d M, Y', $this->tanggal_checkin)->format('Y-m-d');
        $date_checkout = Carbon::createFromFormat('d M, Y', $this->tanggal_checkout)->format('Y-m-d');

        if (session('function') === null) {

            try {
                DB::beginTransaction();
                // Simpan data customer
                $customer_create = customers::create([
                    'cus_name' => $this->cus_name,
                    'cus_address' => $this->cus_address,
                    'cus_phone' => $this->cus_phone,
                    'cus_email' => $this->cus_email,
                    'jnsidentity_id' => $this->jnsidentity_id,
                    'cus_identity_number' => $this->cus_identity_number,
                    'created_by' => $user->user_id,
                ]);

                // Simpan data reservasi
                $rsv_create = rsvLangsung::create([
                    'cus_id' => $customer_create->cus_id,
                    'kamar_id' => $this->kamar_id,
                    'tanggal_checkin' => $date_checkin,
                    'tanggal_checkout' => $date_checkout,
                    'jumlah_tamu' => $this->jumlah_tamu,
                    'sttsrsv_id' => 3,
                    'tipeinap_id' => $this->tipeinap_id,
                    'tarif_kamar' => $this->tarif_kamar,
                    'asal_tarif_kamar' => $this->asal_tarif_kamar,
                    'created_by' => $user->user_id,
                ]);
                $this->rsv_id = $rsv_create->rsv_id;
                // Update status kamar
                namaKamar::where('kamar_id', $this->kamar_id)->update([
                    'sttskmr_id' => 3,
                    'updated_by' => $user->user_id
                ]);
                // Commit transaksi jika semua berhasil
                DB::commit();

                // Reset form dan tampilkan notifikasi sukses
                $this->dispatch('success', [
                    'message' => "Reservasi {$this->cus_name} kamar berhasil dibuat.",
                    'rsv_id' => $rsv_create->rsv_id // Sertakan rsv_id
                ]);
                // $this->resetForm();
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                // Tampilkan pesan error
                $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
            }
        } else {
            try {
                DB::beginTransaction();

                $reservasi_lama = rsvLangsung::find($this->rsv_id); // Ambil reservasi berdasarkan ID
                $kamar_sebelumnya = $reservasi_lama->kamar_id; // Simpan kamar lama

                $customer_update = customers::where('cus_id', $this->cus_id)->update([
                    'cus_name' => $this->cus_name,
                    'cus_address' => $this->cus_address,
                    'cus_phone' => $this->cus_phone,
                    'cus_email' => $this->cus_email,
                    'jnsidentity_id' => $this->jnsidentity_id,
                    'cus_identity_number' => $this->cus_identity_number,
                    'updated_by' => $user->user_id,
                ]);
                $rsv_update = rsvLangsung::where('rsv_id', $this->rsv_id)->update([
                    'cus_id' => $this->cus_id,
                    'kamar_id' => $this->kamar_id,
                    'tanggal_checkin' => $date_checkin,
                    'tanggal_checkout' => $date_checkout,
                    'jumlah_tamu' => $this->jumlah_tamu,
                    'sttsrsv_id' => 3,
                    'tipeinap_id' => $this->tipeinap_id,
                    'tarif_kamar' => $this->tarif_kamar,
                    'asal_tarif_kamar' => $this->asal_tarif_kamar,
                    'updated_by' => $user->user_id,
                ]);

                if ($kamar_sebelumnya != $this->kamar_id) {
                    // Kosongkan kamar lama
                    namaKamar::where('kamar_id', $kamar_sebelumnya)->update([
                        'sttskmr_id' => 1, // Status ready
                        'updated_by' => $user->user_id,
                    ]);

                    // Perbarui status kamar baru
                    namaKamar::where('kamar_id', $this->kamar_id)->update([
                        'sttskmr_id' => 3, // Status occupied
                        'updated_by' => $user->user_id,
                    ]);
                }

                DB::commit();
                $this->dispatch('success', [
                    'message' => "Reservasi {$this->cus_name} kamar berhasil diupdate.",
                ]);
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                // Tampilkan pesan error
                $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
            }
        }
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

        if (!$this->rsv_id) {
            $this->dispatch('showError', "ID reservasi tidak ditemukan, simpan data reservasi dahulu");
        }

        try {
            DB::beginTransaction();
            // Simpan data bill fasilitas
            $bill_fasilitas = fasilitasKamar::create([
                'rsv_id' => $this->rsv_id,
                'faskmr_id' => $this->faskmr_id,
                'tarif_satuan' => $this->tarif_exc,
                'qty' => $this->qty_fasilitas,
                'tarif_total' => $this->total_fasilitas,
                'created_by' => $user->user_id,
            ]);

            DB::commit();
            $this->tableBillFasilitaskamar();
            $nama_fasilitas = DB::table('ms_fasilitas_kmr')
                ->whereNull('deleted_at')
                ->where('faskmr_id', $this->faskmr_id)
                ->first();
            $this->dispatch('success', [
                'message' => "fasilitas {$nama_fasilitas->faskmr_name} berhasil ditambahkan.",
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Tampilkan pesan error
            $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
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
            $this->dispatch('success', [
                'message' => "data berhasil dihapus.",
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Tampilkan pesan error
            $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
        }
    }
    public function createBillExtracharge()
    {
        $user = Auth::user();
        $rules = [
            'charge_id' => ['required'],
            'tarif_charge' => ['required'],
            'qty_extracharge' => ['required'],
            'total_extracharge' => ['required'],
        ];
        $this->validate($rules);

        if (!$this->rsv_id) {
            $this->dispatch('showError', "ID reservasi tidak ditemukan, simpan data reservasi dahulu");
        }

        try {
            DB::beginTransaction();
            // Simpan data bill fasilitas
            $bill_extracharge = trExtraCharge::create([
                'rsv_id' => $this->rsv_id,
                'charge_id' => $this->charge_id,
                'tarif_satuan' => $this->tarif_charge,
                'qty' => $this->qty_extracharge,
                'tarif_total' => $this->total_extracharge,
                'created_by' => $user->user_id,
            ]);

            DB::commit();
            $this->tableBillExtraCharge();
            $nama_extracharge = DB::table('ms_extra_charge')
                ->whereNull('deleted_at')
                ->where('charge_id', $this->charge_id)
                ->first();
            $this->dispatch('success', [
                'message' => "fasilitas {$nama_extracharge->charge_name} berhasil ditambahkan.",
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Tampilkan pesan error
            $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
        }
    }
    public function askDeleteExtracharge($billextracharge_id)
    {
        $this->billextracharge_id = $billextracharge_id;
        $this->dispatch('openDeleteModalExtracharge', [
            'rowId' => $this->billextracharge_id
        ]);
    }
    public function confirmDeleteExtracharge($rowId)
    {
        $user = Auth::user();
        $this->billextracharge_id = $rowId;
        try {
            DB::beginTransaction();
            $data_bill_extracharge = trExtraCharge::find($this->billextracharge_id);
            $delete_data = $data_bill_extracharge->delete();
            if ($delete_data) {
                $data_bill_extracharge->update([
                    'deleted_by' => $user->user_id
                ]);
            }
            DB::commit();
            $this->tableBillExtraCharge();
            $this->dispatch('success', [
                'message' => "data berhasil dihapus.",
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Tampilkan pesan error
            $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
        }
    }
    public function tableBillExtraChargeManual()
    {

        $this->data_bill_extracharge_manual = trExtraChargeManual::query()
            ->join('ms_extra_charge', 'tr_bill_extracharge_manual.charge_id', '=', 'ms_extra_charge.charge_id')
            ->where('rsv_id', $this->rsv_id)
            ->select(
                'tr_bill_extracharge_manual.billextrachargemanual_id',
                'ms_extra_charge.charge_name',
                'ms_extra_charge.charge_id',
                'tr_bill_extracharge_manual.tarif',
                'tr_bill_extracharge_manual.keterangan',
            )
            ->get();
    }
    public function createBillExtrachargeManual()
    {
        $user = Auth::user();
        $rules = [
            'charge_id_manual' => ['required'],
            'tarif_charge_manual' => ['required'],
        ];
        $this->validate($rules);

        if (!$this->rsv_id) {
            $this->dispatch('showError', "ID reservasi tidak ditemukan, simpan data reservasi dahulu");
        }

        try {
            DB::beginTransaction();
            // Simpan data bill fasilitas
            $bill_extracharge = trExtraChargeManual::create([
                'rsv_id' => $this->rsv_id,
                'charge_id' => $this->charge_id_manual,
                'tarif' => $this->tarif_charge_manual,
                'keterangan' => $this->keterangan_charge,
                'created_by' => $user->user_id,
            ]);

            DB::commit();
            $this->tableBillExtraChargeManual();
            $nama_extracharge = DB::table('ms_extra_charge')
                ->whereNull('deleted_at')
                ->where('charge_id', $this->charge_id_manual)
                ->first();
            $this->dispatch('success', [
                'message' => "fasilitas {$nama_extracharge->charge_name} berhasil ditambahkan.",
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Tampilkan pesan error
            $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
        }
    }
    public function askDeleteExtrachargeManual($billextrachargemanual_id)
    {
        $this->billextrachargemanual_id = $billextrachargemanual_id;
        $this->dispatch('openDeleteModalExtrachargeManual', [
            'rowId' => $this->billextrachargemanual_id
        ]);
    }
    public function confirmDeleteExtrachargeManual($rowId)
    {
        $user = Auth::user();
        $this->billextrachargemanual_id = $rowId;
        try {
            DB::beginTransaction();
            $data_bill_extracharge = trExtraChargeManual::find($this->billextrachargemanual_id);
            $delete_data = $data_bill_extracharge->delete();
            if ($delete_data) {
                $data_bill_extracharge->update([
                    'deleted_by' => $user->user_id
                ]);
            }
            DB::commit();
            $this->tableBillExtraChargeManual();
            $this->dispatch('success', [
                'message' => "data berhasil dihapus.",
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Tampilkan pesan error
            $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
        }
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
        if ($this->tipediskon_id == 1) {
            $this->nominal_diskon = $this->nilai_diskon * $this->data_pembayaran_subtotal / 100;
        } else if ($this->tipediskon_id == 2) {
            $this->nominal_diskon = $this->nilai_diskon;
        } else {
            $this->nominal_diskon = 0;
        }
        $this->dataPembayaran();
    }
    public function dataPembayaran()
    {
        $user = Auth::user();
        $rsv_id = $this->rsv_id;
        $load_data_rsv = rsvLangsung::find($this->rsv_id);
        if ($load_data_rsv) {
            $this->stts_bill = $load_data_rsv->sttsrsv_id;
            $load_data_customer = customers::find($load_data_rsv->cus_id);
            $load_data_bill_kamar = DB::table('tr_reservasi_kmr')
                ->where('rsv_id', $load_data_rsv->rsv_id)
                ->where('deleted_at', null)
                ->select('tanggal_checkin', 'tanggal_checkout', 'tarif_kamar') // Menggunakan DB::raw untuk fungsi SUM
                ->first();
            $load_data_bill_fasilitas = DB::table('tr_bill_fasilitas_kmr')
                ->where('rsv_id', $load_data_rsv->rsv_id)
                ->where('deleted_at', null)
                ->select(DB::raw('SUM(tarif_total) as total_tarif_bill_fasilitas')) // Menggunakan DB::raw untuk fungsi SUM
                ->first();
            $load_data_bill_extracharge = DB::table('tr_bill_extracharge_kmr')
                ->where('rsv_id', $load_data_rsv->rsv_id)
                ->where('deleted_at', null)
                ->select(DB::raw('SUM(tarif_total) as total_tarif_bill_extracharge')) // Menggunakan DB::raw untuk fungsi SUM
                ->first();
            $load_data_bill_extracharge_manual = DB::table('tr_bill_extracharge_manual')
                ->where('rsv_id', $load_data_rsv->rsv_id)
                ->where('deleted_at', null)
                ->select(DB::raw('SUM(tarif) as total_tarif_bill_extracharge_manual')) // Menggunakan DB::raw untuk fungsi SUM
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

            $jumlah_tarif_kamar = $load_data_bill_kamar->tarif_kamar * $selisihHari;
            $this->data_pembayaran_cus_name = $load_data_customer->cus_name;
            $this->data_pembayaran_cus_address = $load_data_customer->cus_address;
            $this->data_pembayaran_total_bill_kamar = $jumlah_tarif_kamar;
            $this->data_pajak = $load_pajak->besaran_pajak ?? 0;
            $this->data_pembayaran_total_fasilitas = $load_data_bill_fasilitas->total_tarif_bill_fasilitas ?? 0;
            $this->data_pembayaran_total_extracharge = $load_data_bill_extracharge->total_tarif_bill_extracharge ?? 0;
            $this->data_pembayaran_total_extracharge_manual = $load_data_bill_extracharge_manual->total_tarif_bill_extracharge_manual ?? 0;
            $this->data_pembayaran_subtotal = $this->data_pembayaran_total_bill_kamar + $this->data_pembayaran_total_fasilitas + $this->data_pembayaran_total_extracharge + $this->data_pembayaran_total_extracharge_manual;
            $this->data_pembayaran_kamar_fasilitas = $this->data_pembayaran_total_bill_kamar + $this->data_pembayaran_total_fasilitas - $this->nominal_diskon;
            $this->data_pembayaran_grandtotal = ($this->data_pembayaran_kamar_fasilitas + $this->data_pembayaran_total_extracharge + $this->data_pembayaran_total_extracharge_manual) + ($this->data_pembayaran_kamar_fasilitas * $load_pajak->besaran_pajak / 100);
            //$this->data_pembayaran_grandtotal = ($this->data_pembayaran_subtotal - $this->nominal_diskon) + (($this->data_pembayaran_subtotal - $this->nominal_diskon) * $load_pajak->besaran_pajak / 100);
        }
    }
    public function checkoutBill()
    {
        $user = Auth::user();
        if (!$this->rsv_id) {
            $this->dispatch('showError', "data reservasi tidak ditemukan");
        }

        try {
            DB::beginTransaction();

            // Update status di reservasi
            if (rsvLangsung::where('rsv_id', $this->rsv_id)->exists()) {
                rsvLangsung::where('rsv_id', $this->rsv_id)
                    ->update([
                        'sttsrsv_id' => '4',
                        'updated_by' => $user->user_id
                    ]);

                $data_reservasi = rsvLangsung::find($this->rsv_id);
                namaKamar::where('kamar_id', $data_reservasi->kamar_id)
                    ->update([
                        'sttskmr_id' => '2',
                        'updated_by' => $user->user_id
                    ]);
            }
            // Update status di tabel fasilitas jika ada data
            if (fasilitasKamar::where('rsv_id', $this->rsv_id)->exists()) {
                fasilitasKamar::where('rsv_id', $this->rsv_id)
                    ->update([
                        'sttsbill_id' => '1',
                        'updated_by' => $user->user_id
                    ]);
            }

            // Update status di tabel extra charge jika ada data
            if (trExtraCharge::where('rsv_id', $this->rsv_id)->exists()) {
                trExtraCharge::where('rsv_id', $this->rsv_id)
                    ->update([
                        'sttsbill_id' => '1',
                        'updated_by' => $user->user_id
                    ]);
            }

            // Update status di tabel extra charge manual jika ada data
            if (trExtraChargeManual::where('rsv_id', $this->rsv_id)->exists()) {
                trExtraChargeManual::where('rsv_id', $this->rsv_id)
                    ->update([
                        'sttsbill_id' => '1',
                        'updated_by' => $user->user_id
                    ]);
            }

            DB::commit();

            $this->dataPembayaran();
            $this->createInvoice();
            $this->dispatch('success', [
                'message' => "data reservasi berhasil di check-out.",
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Tampilkan pesan error
            $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
        }
    }
    public function batalCheckoutBill()
    {
        $user = Auth::user();
        if (!$this->rsv_id) {
            $this->dispatch('showError', "data reservasi tidak ditemukan");
        }

        $data_reservasi = rsvLangsung::find($this->rsv_id);
        $cek_stts_kmr = namaKamar::where('kamar_id', $data_reservasi->kamar_id)->first();
        if ($cek_stts_kmr->sttskmr_id != 1 && $cek_stts_kmr->sttskmr_id != 2) {
            $this->dispatch('showError', "kamar lama telah digunakan, silahkan buat data reservasi baru");
            return;
        } else {
            try {
                DB::beginTransaction();

                // Update status di reservasi
                if (rsvLangsung::where('rsv_id', $this->rsv_id)->exists()) {
                    rsvLangsung::where('rsv_id', $this->rsv_id)
                        ->update([
                            'sttsrsv_id' => '3',
                            'updated_by' => $user->user_id
                        ]);

                    $data_reservasi = rsvLangsung::find($this->rsv_id);
                    namaKamar::where('kamar_id', $data_reservasi->kamar_id)
                        ->update([
                            'sttskmr_id' => '3',
                            'updated_by' => $user->user_id
                        ]);
                }
                // Update status di tabel fasilitas jika ada data
                if (fasilitasKamar::where('rsv_id', $this->rsv_id)->exists()) {
                    fasilitasKamar::where('rsv_id', $this->rsv_id)
                        ->update([
                            'sttsbill_id' => '2',
                            'updated_by' => $user->user_id
                        ]);
                }

                // Update status di tabel extra charge jika ada data
                if (trExtraCharge::where('rsv_id', $this->rsv_id)->exists()) {
                    trExtraCharge::where('rsv_id', $this->rsv_id)
                        ->update([
                            'sttsbill_id' => '2',
                            'updated_by' => $user->user_id
                        ]);
                }

                // Update status di tabel extra charge manual jika ada data
                if (trExtraChargeManual::where('rsv_id', $this->rsv_id)->exists()) {
                    trExtraChargeManual::where('rsv_id', $this->rsv_id)
                        ->update([
                            'sttsbill_id' => '2',
                            'updated_by' => $user->user_id
                        ]);
                }
                if (invoice::where('rsv_id', $this->rsv_id)->exists()) {
                    invoice::where('rsv_id', $this->rsv_id)
                        ->update([
                            'sttsbill_id' => '2',
                            'updated_by' => $user->user_id
                        ]);
                }

                DB::commit();
                $this->dataPembayaran();
                $this->dispatch('success', [
                    'message' => "data reservasi berhasil di batal check-out.",
                ]);
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                // Tampilkan pesan error
                $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
            }
        }
    }
    public function createInvoice()
    {
        $user = Auth::user();
        if (!$this->rsv_id) {
            $this->dispatch('showError', "data reservasi tidak ditemukan");
        }
        $this->dataPembayaran();
        $data_reservasi = rsvLangsung::find($this->rsv_id);
        $cek_invoice = DB::table('tr_bill_total')
            ->where('rsv_id', $this->rsv_id)
            ->where('deleted_at', null)
            ->first();
        if (!$cek_invoice) {
            try {
                DB::beginTransaction();
                $tanggal_invoice = date('Ymd');
                $invoice_path = "inv/{$tanggal_invoice}/{$this->rsv_id}";
                $create_invoice = invoice::create([
                    'no_invoice' => $invoice_path,
                    'rsv_id' => $this->rsv_id,
                    'total_bill_kmr' => $this->data_pembayaran_total_bill_kamar,
                    'total_bill_fasilitas' => $this->data_pembayaran_total_fasilitas,
                    'total_bill_extracharge' => $this->data_pembayaran_total_extracharge,
                    'total_bill_extracharge_manual' => $this->data_pembayaran_total_extracharge_manual,
                    'subtotal' => $this->data_pembayaran_subtotal,
                    'tipediskon_id' => $this->tipediskon_id ?? 0,
                    'nominal_diskon' => $this->nominal_diskon ?? 0,
                    'pajak' => $this->data_pajak,
                    'nominal_pajak' => ($this->data_pajak * ($this->data_pembayaran_total_bill_kamar + $this->data_pembayaran_total_fasilitas)) / 100,
                    'grand_total' => $this->data_pembayaran_grandtotal
                ]);

                DB::commit();
                $this->dataPembayaran();
                $this->billtotal_id = $create_invoice->billtotal_id;
                $invoice_url = url("/transaksi/reservasi/direct/invoice/{$this->billtotal_id}");
                $this->dispatch('openInvoice', [
                    'url' => $invoice_url,
                ]);
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                // Tampilkan pesan error
                $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
            }
        } else {
            try {
                DB::beginTransaction();
                $tanggal_invoice = date('Ymd');
                $invoice_path = "inv/{$tanggal_invoice}/{$this->rsv_id}";
                $update_invoice = invoice::where('billtotal_id', $cek_invoice->billtotal_id)->update([
                    'no_invoice' => $invoice_path,
                    'rsv_id' => $this->rsv_id,
                    'total_bill_kmr' => $this->data_pembayaran_total_bill_kamar,
                    'total_bill_fasilitas' => $this->data_pembayaran_total_fasilitas,
                    'total_bill_extracharge' => $this->data_pembayaran_total_extracharge,
                    'total_bill_extracharge_manual' => $this->data_pembayaran_total_extracharge_manual,
                    'subtotal' => $this->data_pembayaran_subtotal,
                    'tipediskon_id' => $this->tipediskon_id ?? 0,
                    'nominal_diskon' => $this->nominal_diskon ?? 0,
                    'pajak' => $this->data_pajak,
                    // 'nominal_pajak' => ($this->data_pajak * $this->data_pembayaran_subtotal) / 100,
                    'nominal_pajak' => ($this->data_pajak * ($this->data_pembayaran_total_bill_kamar + $this->data_pembayaran_total_fasilitas)) / 100,
                    'grand_total' => $this->data_pembayaran_grandtotal
                ]);

                DB::commit();
                $this->dataPembayaran();
                $invoice_url = url("/transaksi/reservasi/direct/invoice/{$cek_invoice->billtotal_id}");
                $this->dispatch('openInvoice', [
                    'url' => $invoice_url,
                ]);
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                // Tampilkan pesan error
                $this->dispatch('showError', "Terjadi kesalahan: " . $e->getMessage());
            }
        }
    }
    public function createInvoiceDasar()
    {
        $cek_invoice = DB::table('tr_bill_total')
            ->where('rsv_id', $this->rsv_id)
            ->where('deleted_at', null)
            ->first();
        $invoice_url = url("/transaksi/reservasi/direct/invoicedasar/{$cek_invoice->billtotal_id}");
        $this->dispatch('openInvoiceDasar', [
            'url' => $invoice_url,
        ]);
    }
    public function createInvoiceExtra()
    {
        $cek_invoice = DB::table('tr_bill_total')
            ->where('rsv_id', $this->rsv_id)
            ->where('deleted_at', null)
            ->first();
        $invoice_url = url("/transaksi/reservasi/direct/invoiceextra/{$cek_invoice->billtotal_id}");
        $this->dispatch('openInvoiceExtra', [
            'url' => $invoice_url,
        ]);
    }
    public function loadRSV()
    {
        $this->rsv_id = session('rsv_id');
        $this->cus_id = session('cus_id');
        if ($this->rsv_id) {
            $data_RSV = rsvLangsung::find($this->rsv_id);
            if ($data_RSV) {
                $data_customer = customers::find($data_RSV->cus_id);
                $data_kamar = namaKamar::find($data_RSV->kamar_id);
                $tgl_checkin = Carbon::parse($data_RSV->tanggal_checkin)->format('d M, Y');
                $tgl_checkout = Carbon::parse($data_RSV->tanggal_checkout)->format('d M, Y');
                $this->tanggal_checkin = $tgl_checkin;
                $this->tanggal_checkout = $tgl_checkout;
                $this->klskmr_id = $data_kamar->klskmr_id;
                $this->updatedTipeinapId();
                $this->updatedKlskmrId();
                $this->kamar_id = $data_RSV->kamar_id;
                $this->jumlah_tamu = $data_RSV->jumlah_tamu;
                $this->tipeinap_id = $data_RSV->tipeinap_id;
                $this->cus_name = $data_customer->cus_name;
                $this->cus_address = $data_customer->cus_address;
                $this->cus_phone = $data_customer->cus_phone;
                $this->cus_email = $data_customer->cus_email;
                $this->jnsidentity_id = $data_customer->jnsidentity_id;
                $this->cus_identity_number = $data_customer->cus_identity_number;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['rsv_id', 'cus_id', 'function']);
        return redirect()->to('/transaksi/reservasi/direct');
    }
    public function render()
    {
        return view('livewire.transaksi.rsv-langsung.rsv-langsung-form');
    }
}
