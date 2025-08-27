<?php

namespace App\Livewire\Master\TarifLayanan\TarifKhusus;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\tarifKhusus;
use Illuminate\Support\Carbon;

class TarifKhususForm extends Component
{
    #[Layout('components.layouts.app')]
    public $trkhusus_id;
    public $trkhusus_fullday;
    public $trkhusus_halfday;
    public $klskmr_id;
    public $tanggal_awal;
    public $tanggal_akhir;
    public $keterangan;
    public $kelasKamars = [];
    public function resetForm()
    {
        $this->trkhusus_id = null;
        $this->reset(['trkhusus_fullday', 'trkhusus_halfday', 'klskmr_id', 'tanggal_awal', 'tanggal_akhir', 'keterangan']);
    }
    public function mount()
    {
        $this->loadTarifKhusus();
        $this->kelasKamars = DB::table('ms_kelas_kmr')->where('deleted_at', null)->pluck('klskmr_name', 'klskmr_id');
    }
    public function createTarifKhusus()
    {
        $user = Auth::user();

        // Aturan validasi
        $rules = [
            'trkhusus_fullday' => ['required'],
            'trkhusus_halfday' => ['required'],
            'klskmr_id' => ['required'],
            'tanggal_awal' => ['required'],
            'tanggal_akhir' => ['required'],
        ];
        $this->validate($rules);

        // Konversi tanggal awal dan akhir ke format database
        $tanggal_awal_db = Carbon::createFromFormat('d.m.y H:i', $this->tanggal_awal)->format('Y-m-d H:i:s');
        $tanggal_akhir_db = Carbon::createFromFormat('d.m.y H:i', $this->tanggal_akhir)->format('Y-m-d H:i:s');

        // Cek apakah kombinasi tanggal dan klskmr_id sudah ada
        $isOverlapping = tarifKhusus::where('klskmr_id', $this->klskmr_id)
            ->where(function ($query) use ($tanggal_awal_db, $tanggal_akhir_db) {
                $query->where(function ($q) use ($tanggal_awal_db) {
                    $q->where('tanggal_awal', '<=', $tanggal_awal_db)
                        ->where('tanggal_akhir', '>=', $tanggal_awal_db);
                })
                    ->orWhere(function ($q) use ($tanggal_akhir_db) {
                        $q->where('tanggal_awal', '<=', $tanggal_akhir_db)
                            ->where('tanggal_akhir', '>=', $tanggal_akhir_db);
                    })
                    ->orWhere(function ($q) use ($tanggal_awal_db, $tanggal_akhir_db) {
                        $q->where('tanggal_awal', '>=', $tanggal_awal_db)
                            ->where('tanggal_akhir', '<=', $tanggal_akhir_db);
                    });
            })
            ->exists();

        if (session('function') === null) {
            if ($isOverlapping) {
                $this->dispatch('showError', [
                    'type' => 'error', // atau 'error' sesuai kebutuhan
                    'message' => "Tanggal yang Anda masukkan beririsan dengan periode lain untuk kelas kamar ini."
                ]);
                return;
            }
            $kamar_create = tarifKhusus::create([
                'trkhusus_fullday' => $this->trkhusus_fullday,
                'trkhusus_halfday' => $this->trkhusus_halfday,
                'klskmr_id' => $this->klskmr_id,
                'tanggal_awal' => $tanggal_awal_db,
                'tanggal_akhir' => $tanggal_akhir_db,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "Tarif kamar berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            if ($isOverlapping) {
                $this->dispatch('showError', [
                    'type' => 'error', // atau 'error' sesuai kebutuhan
                    'message' => "Tanggal yang Anda masukkan beririsan dengan periode lain untuk kelas kamar ini."
                ]);
                return;
            }
            $kamar_update = tarifKhusus::where('trkhusus_id', $this->trkhusus_id)->update([
                'trkhusus_fullday' => $this->trkhusus_fullday,
                'trkhusus_halfday' => $this->trkhusus_halfday,
                'klskmr_id' => $this->klskmr_id,
                'tanggal_awal' => $tanggal_awal_db,
                'tanggal_akhir' => $tanggal_akhir_db,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "Tarif kamar berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadTarifKhusus()
    {
        $this->trkhusus_id = session('trkhusus_id');
        if ($this->trkhusus_id) {
            $tarif_kamar = tarifKhusus::find($this->trkhusus_id);
            if ($tarif_kamar) {
                $tanggal_awal_db = Carbon::createFromFormat('Y-m-d H:i:s', $tarif_kamar->tanggal_awal)->format('d.m.y H:i');
                $tanggal_akhir_db = Carbon::createFromFormat('Y-m-d H:i:s', $tarif_kamar->tanggal_akhir)->format('d.m.y H:i');
                $this->trkhusus_fullday = $tarif_kamar->trkhusus_fullday;
                $this->trkhusus_halfday = $tarif_kamar->trkhusus_halfday;
                $this->klskmr_id = $tarif_kamar->klskmr_id;
                $this->tanggal_awal = $tanggal_awal_db;
                $this->tanggal_akhir = $tanggal_akhir_db;
                $this->keterangan = $tarif_kamar->keterangan;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['trkhusus_id', 'function']);
        return redirect()->to('/master/tariflayanan/tarifkhusus');
    }
    public function render()
    {
        return view('livewire.master.tarif-layanan.tarif-khusus.tarif-khusus-form');
    }
}
