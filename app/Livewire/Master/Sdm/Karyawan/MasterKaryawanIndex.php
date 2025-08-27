<?php

namespace App\Livewire\Master\Sdm\Karyawan;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MasterKaryawanIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableKaryawanLoaded = false;
    public function loadTableKaryawan()
    {
        $this->isTableKaryawanLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createKaryawan()
    {
        session()->forget(['karyawan_id', 'function']);

        $this->redirect('/master/sdm/masterkaryawan/create');
    }
    public function render()
    {
        return view('livewire.master.sdm.karyawan.master-karyawan-index');
    }
}
