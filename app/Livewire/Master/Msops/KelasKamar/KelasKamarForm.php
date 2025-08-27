<?php

namespace App\Livewire\Master\Msops\KelasKamar;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\kelasKamar;

class KelasKamarForm extends Component
{
    #[Layout('components.layouts.app')]
    public $klskmr_id;
    public $klskmr_name;
    public $klskmr_desc;
    public $tarif_dasar_fullday;
    public $tarif_dasar_halfday;
    public $isTableFasilitasKelaskmrLoaded = false;
    public $fasilitas = [];
    public $selectedFasilitas = [];
    public function loadTablefasilitasKelaskmr()
    {
        $this->isTableFasilitasKelaskmrLoaded = true;
    }
    public function resetForm()
    {
        $this->klskmr_id = null;
        $this->reset(['klskmr_name', 'klskmr_desc', 'tarif_dasar_fullday', 'tarif_dasar_halfday', 'selectedFasilitas']);
    }
    public function mount()
    {
        $this->loadKelaskmr();
        $this->loadFasilitas();
    }
    public function createKelaskmr()
    {
        $user = Auth::user();
        $rules = [
            'klskmr_name' => ['required'],
            'klskmr_desc' => ['required'],
            'tarif_dasar_fullday' => ['required', 'numeric'],
            'tarif_dasar_halfday' => ['required', 'numeric'],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $kelaskmr_create = kelasKamar::create([
                'klskmr_name' => $this->klskmr_name,
                'klskmr_desc' => $this->klskmr_desc,
                'tarif_dasar_fullday' => $this->tarif_dasar_fullday,
                'tarif_dasar_halfday' => $this->tarif_dasar_halfday,
                'created_by' => $user->user_id,
            ]);
            if (!empty($this->selectedFasilitas)) {
                foreach ($this->selectedFasilitas as $fasilitasId) {
                    DB::table('ms_fasilitas_kelas_kmr')->insert([
                        'klskmr_id' => $kelaskmr_create->klskmr_id,
                        'faskmr_id' => $fasilitasId,
                    ]);
                }
            }
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "kelas kamar {$this->klskmr_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $kelaskmr_update = kelasKamar::where('klskmr_id', $this->klskmr_id)->update([
                'klskmr_name' => $this->klskmr_name,
                'klskmr_desc' => $this->klskmr_desc,
                'tarif_dasar_fullday' => $this->tarif_dasar_fullday,
                'tarif_dasar_halfday' => $this->tarif_dasar_halfday,
                'updated_by' => $user->user_id,
            ]);
            // Ambil data fasilitas lama
            $existingFasilitas = DB::table('ms_fasilitas_kelas_kmr')
                ->where('klskmr_id', $this->klskmr_id)
                ->get()
                ->keyBy('faskmr_id');

            // Proses data baru
            foreach ($this->selectedFasilitas as $fasilitasId) {
                if (isset($existingFasilitas[$fasilitasId])) {
                    // Hapus dari daftar existing, karena sudah diproses
                    unset($existingFasilitas[$fasilitasId]);
                } else {
                    // Jika fasilitas baru, lakukan insert
                    DB::table('ms_fasilitas_kelas_kmr')->insert([
                        'klskmr_id' => $this->klskmr_id,
                        'faskmr_id' => $fasilitasId,
                    ]);
                }
            }
            // Hapus fasilitas yang tidak lagi dipilih
            foreach ($existingFasilitas as $fasilitasId => $data) {
                DB::table('ms_fasilitas_kelas_kmr')
                    ->where('klskmr_id', $this->klskmr_id)
                    ->where('faskmr_id', $fasilitasId)
                    ->delete();
            }
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "kelas kamar {$this->klskmr_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadKelaskmr()
    {
        $this->klskmr_id = session('klskmr_id');
        if ($this->klskmr_id) {
            $kelas_kamar = kelasKamar::find($this->klskmr_id);
            if ($kelas_kamar) {
                $this->klskmr_name = $kelas_kamar->klskmr_name;
                $this->klskmr_desc = $kelas_kamar->klskmr_desc;
                $this->tarif_dasar_fullday = $kelas_kamar->tarif_dasar_fullday;
                $this->tarif_dasar_halfday = $kelas_kamar->tarif_dasar_halfday;

                $fasilitasData = DB::table('ms_fasilitas_kelas_kmr')
                    ->where('klskmr_id', $this->klskmr_id)
                    ->get();

                $this->selectedFasilitas = $fasilitasData->pluck('faskmr_id')->toArray();
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function loadFasilitas()
    {
        $this->fasilitas = DB::table('ms_fasilitas_kmr')
            ->where('deleted_at', '=', null)->get()->toArray();
    }
    public function goBack()
    {
        session()->forget(['klskmr_id', 'function']);
        return redirect()->to('/master/ops/kelaskamar');
    }
    public function render()
    {
        return view('livewire.master.msops.kelas-kamar.kelas-kamar-form');
    }
}
