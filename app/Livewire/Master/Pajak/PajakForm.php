<?php

namespace App\Livewire\Master\Pajak;

use App\Models\master\pajak;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\rekeningBank;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PajakForm extends Component
{
    #[Layout('components.layouts.app')]
    public $pajak_id;
    public $pajak_name;
    public $besaran_pajak;
    public function resetForm()
    {
        $this->pajak_id = null;
        $this->reset();
    }
    public function create()
    {
        $user = Auth::user();

        $update = pajak::where('pajak_id', $this->pajak_id)->update([
            'pajak_name' => $this->pajak_name,
            'besaran_pajak' => $this->besaran_pajak,
            'updated_by' => $user->user_id,
        ]);
        $this->dispatch('resetForm', [
            'type' => 'success', // atau 'error' sesuai kebutuhan
            'message' => "pajak {$this->pajak_name} berhasil diupdate."
        ]);
        $this->resetForm();
    }
    public function loadData()
    {
        $this->pajak_id = session('pajak_id');
        if ($this->pajak_id) {
            $data = pajak::find($this->pajak_id);
            if ($data) {
                $this->pajak_name = $data->pajak_name;
                $this->besaran_pajak = $data->besaran_pajak;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function mount()
    {
        $this->loadData();
    }
    public function goBack()
    {
        session()->forget(['pajak_id', 'function']);
        return redirect()->to('/master/pajak/pajakindex');
    }
    public function render()
    {
        return view('livewire.master.pajak.pajak-form');
    }
}
