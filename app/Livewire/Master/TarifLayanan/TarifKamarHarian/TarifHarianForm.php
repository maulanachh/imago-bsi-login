<?php

namespace App\Livewire\Master\TarifLayanan\TarifKamarHarian;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\tarifHarian;

class TarifHarianForm extends Component
{
    #[Layout('components.layouts.app')]
    public $dailyrate_id;
    public $tarif_harian_fullday;
    public $tarif_harian_halfday;
    public $klskmr_id;
    public $day_id;
    public $days = [];
    public $kelasKamars = [];
    public function resetForm()
    {
        $this->dailyrate_id = null;
        $this->reset(['tarif_harian_fullday', 'tarif_harian_halfday', 'klskmr_id', 'day_id']);
    }
    public function mount()
    {
        $this->loadTarifHarian();
        $this->days = DB::table('ms_days')->where('deleted_at', null)->pluck('day_name', 'day_id');
        $this->kelasKamars = DB::table('ms_kelas_kmr')->where('deleted_at', null)->pluck('klskmr_name', 'klskmr_id');
    }
    public function createTarifHarian()
    {
        $user = Auth::user();

        // Aturan validasi
        $rules = [
            'tarif_harian_fullday' => ['required'],
            'tarif_harian_halfday' => ['required'],
            'klskmr_id' => ['required'],
            'day_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    $query = tarifHarian::where('klskmr_id', $this->klskmr_id)
                        ->where('day_id', $value);

                    if ($this->dailyrate_id) {
                        $query->where('dailyrate_id', '!=', $this->dailyrate_id);
                    }

                    $exists = $query->exists();

                    if ($exists) {
                        $fail('Kombinasi kelas kamar dan hari sudah ada.');
                    }
                }
            ],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $kamar_create = tarifHarian::create([
                'tarif_harian_fullday' => $this->tarif_harian_fullday,
                'tarif_harian_halfday' => $this->tarif_harian_halfday,
                'klskmr_id' => $this->klskmr_id,
                'day_id' => $this->day_id,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "Tarif kamar berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $kamar_update = tarifHarian::where('dailyrate_id', $this->dailyrate_id)->update([
                'tarif_harian_fullday' => $this->tarif_harian_fullday,
                'tarif_harian_halfday' => $this->tarif_harian_halfday,
                'klskmr_id' => $this->klskmr_id,
                'day_id' => $this->day_id,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "Tarif kamar berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }

    public function loadTarifHarian()
    {
        $this->dailyrate_id = session('dailyrate_id');
        if ($this->dailyrate_id) {
            $tarif_kamar = tarifHarian::find($this->dailyrate_id);
            if ($tarif_kamar) {
                $this->tarif_harian_fullday = $tarif_kamar->tarif_harian_fullday;
                $this->tarif_harian_halfday = $tarif_kamar->tarif_harian_halfday;
                $this->klskmr_id = $tarif_kamar->klskmr_id;
                $this->day_id = $tarif_kamar->day_id;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['dailyrate_id', 'function']);
        return redirect()->to('/master/tariflayanan/tarifharian');
    }
    public function render()
    {
        return view('livewire.master.tarif-layanan.tarif-kamar-harian.tarif-harian-form');
    }
}
