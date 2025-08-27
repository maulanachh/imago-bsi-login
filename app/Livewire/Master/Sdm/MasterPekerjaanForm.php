<?php

namespace App\Livewire\Master\Sdm;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\MasterPekerjaan;

class MasterPekerjaanForm extends Component
{
    #[Layout('components.layouts.app')]
    public $pekerjaan_id;
    public $pekerjaan_name;
    public function resetForm()
    {
        $this->pekerjaan_id = null;
        $this->reset();
    }
    public function mount()
    {
        $this->loadJnsPekerjaan();
    }
    public function createJnsPekerjaan()
    {
        $user = Auth::user();
        $rules = [
            'pekerjaan_name' => ['required'],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $jnspekerjaan_create = MasterPekerjaan::create([
                'pekerjaan_name' => $this->pekerjaan_name,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "jenis pekerjaan {$this->pekerjaan_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $jnspekerjaan_update = MasterPekerjaan::where('pekerjaan_id', $this->pekerjaan_id)->update([
                'pekerjaan_name' => $this->pekerjaan_name,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "jenis pekerjaan {$this->pekerjaan_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadJnsPekerjaan()
    {
        $this->pekerjaan_id = session('pekerjaan_id');
        if ($this->pekerjaan_id) {
            $jnspekerjaan = MasterPekerjaan::find($this->pekerjaan_id);
            if ($jnspekerjaan) {
                $this->pekerjaan_name = $jnspekerjaan->pekerjaan_name;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['pekerjaan_id', 'function']);
        return redirect()->to('/master/sdm/masterpekerjaan');
    }
    public function render()
    {
        return view('livewire.master.sdm.master-pekerjaan-form');
    }
}
