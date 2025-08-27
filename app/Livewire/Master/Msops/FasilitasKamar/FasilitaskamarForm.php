<?php

namespace App\Livewire\Master\Msops\Fasilitaskamar;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\master\fasilitasKamar;
use Illuminate\Validation\Rule;

class FasilitaskamarForm extends Component
{
    #[Layout('components.layouts.app')]
    public $faskmr_id;
    public $faskmr_name;
    public $faskmr_desc;
    public $tarif_exc;
    public function resetForm()
    {
        $this->faskmr_id = null;
        $this->reset();
    }
    public function mount()
    {
        $this->loadFasilitas();
    }
    public function createFasilitas()
    {
        $user = Auth::user();
        $rules = [
            'faskmr_name' => ['required'],
            'faskmr_desc' => ['required'],
            'tarif_exc' => ['numeric'],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $fasilitas_create = fasilitasKamar::create([
                'faskmr_name' => $this->faskmr_name,
                'faskmr_desc' => $this->faskmr_desc,
                'tarif_exc' => $this->tarif_exc,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "fasilitas {$this->faskmr_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $fasilitas_update = fasilitasKamar::where('faskmr_id', $this->faskmr_id)->update([
                'faskmr_name' => $this->faskmr_name,
                'faskmr_desc' => $this->faskmr_desc,
                'tarif_exc' => $this->tarif_exc,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "fasilitas {$this->faskmr_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }

    public function loadFasilitas()
    {
        $this->faskmr_id = session('faskmr_id');
        if ($this->faskmr_id) {
            $fasilitas = fasilitasKamar::find($this->faskmr_id);
            if ($fasilitas) {
                $this->faskmr_name = $fasilitas->faskmr_name;
                $this->faskmr_desc = $fasilitas->faskmr_desc;
                $this->tarif_exc = $fasilitas->tarif_exc;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }

    public function goBack()
    {
        session()->forget(['faskmr_id', 'function']);
        return redirect()->to('/master/ops/fasilitaskamar');
    }
    public function render()
    {
        return view('livewire.master.msops.fasilitaskamar.fasilitaskamar-form');
    }
}
