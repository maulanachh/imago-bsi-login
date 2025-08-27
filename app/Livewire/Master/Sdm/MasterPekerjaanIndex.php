<?php

namespace App\Livewire\Master\Sdm;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MasterPekerjaanIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTablejnspekerjaanLoaded = false;
    public function loadTablejnspekerjaan()
    {
        $this->isTablejnspekerjaanLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createJnsPekerjaan()
    {
        session()->forget(['pekerjaan_id', 'function']);

        $this->redirect('/master/sdm/masterpekerjaan/create');
    }
    public function render()
    {
        return view('livewire.master.sdm.master-pekerjaan-index');
    }
}
