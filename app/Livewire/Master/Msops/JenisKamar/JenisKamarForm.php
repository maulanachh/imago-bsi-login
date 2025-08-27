<?php

namespace App\Livewire\Master\Msops\JenisKamar;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\jenisKamar;

class JenisKamarForm extends Component
{
    #[Layout('components.layouts.app')]
    public $jnskmr_id;
    public $jnskmr_name;
    public $jnskmr_desc;
    public function resetForm()
    {
        $this->jnskmr_id = null;
        $this->reset();
    }
    public function mount()
    {
        $this->loadJnsKmr();
    }
    public function createJnsKmr()
    {
        $user = Auth::user();
        $rules = [
            'jnskmr_name' => ['required'],
            'jnskmr_desc' => ['required'],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            $jnskmr_create = jenisKamar::create([
                'jnskmr_name' => $this->jnskmr_name,
                'jnskmr_desc' => $this->jnskmr_desc,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "jenis kamar {$this->jnskmr_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $jnskmr_update = jenisKamar::where('jnskmr_id', $this->jnskmr_id)->update([
                'jnskmr_name' => $this->jnskmr_name,
                'jnskmr_desc' => $this->jnskmr_desc,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "jenis kamar {$this->jnskmr_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadJnsKmr()
    {
        $this->jnskmr_id = session('jnskmr_id');
        if ($this->jnskmr_id) {
            $jnskmr = jenisKamar::find($this->jnskmr_id);
            if ($jnskmr) {
                $this->jnskmr_name = $jnskmr->jnskmr_name;
                $this->jnskmr_desc = $jnskmr->jnskmr_desc;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['jnskmr_id', 'function']);
        return redirect()->to('/master/ops/jeniskamar');
    }
    public function render()
    {
        return view('livewire.master.msops.jenis-kamar.jenis-kamar-form');
    }
}
