<?php

namespace App\Livewire\Master\Msops\NamaKamar;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\namaKamar;

class NamaKamarForm extends Component
{
    #[Layout('components.layouts.app')]
    public $kamar_id;
    public $kamar_code;
    public $kamar_name;
    public $klskmr_id;
    public $jnskmr_id;
    public $jenisKamars = [];
    public $kelasKamars = [];
    public function resetForm()
    {
        $this->kamar_id = null;
        $this->reset(['kamar_name', 'klskmr_id', 'jnskmr_id']);
    }
    public function mount()
    {
        $this->loadKamar();
        $this->jenisKamars = DB::table('ms_jenis_kmr')->where('deleted_at', null)->pluck('jnskmr_name', 'jnskmr_id');
        $this->kelasKamars = DB::table('ms_kelas_kmr')->where('deleted_at', null)->pluck('klskmr_name', 'klskmr_id');
    }
    public function createKamar()
    {
        $user = Auth::user();
        $rules = [
            'kamar_name' => ['required'],
            'klskmr_id' => ['required'],
            'jnskmr_id' => ['required'],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $kamar_create = namaKamar::create([
                'kamar_name' => $this->kamar_name,
                'klskmr_id' => $this->klskmr_id,
                'jnskmr_id' => $this->jnskmr_id,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => " kamar {$this->kamar_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $kamar_update = namaKamar::where('kamar_id', $this->kamar_id)->update([
                'kamar_name' => $this->kamar_name,
                'klskmr_id' => $this->klskmr_id,
                'jnskmr_id' => $this->jnskmr_id,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => " kamar {$this->kamar_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadKamar()
    {
        $this->kamar_id = session('kamar_id');
        if ($this->kamar_id) {
            $nama_kamar = namaKamar::find($this->kamar_id);
            if ($nama_kamar) {
                $this->kamar_name = $nama_kamar->kamar_name;
                $this->klskmr_id = $nama_kamar->klskmr_id;
                $this->jnskmr_id = $nama_kamar->jnskmr_id;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['kamar_id', 'function']);
        return redirect()->to('/master/ops/namakamar');
    }
    public function render()
    {
        return view('livewire.master.msops.nama-kamar.nama-kamar-form');
    }
}
