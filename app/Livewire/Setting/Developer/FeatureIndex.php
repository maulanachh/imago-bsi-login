<?php

namespace App\Livewire\Setting\Developer;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\feature;

class FeatureIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableFeatureLoaded = false;

    public function loadTableFeature()
    {
        $this->isTableFeatureLoaded = true;
    }
    public function createFeature()
    {
        session()->forget(['feature_id', 'function']);

        $this->redirect('/setting/developer/masterfitur/create');
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function render()
    {
        return view('livewire.setting.developer.feature-index');
    }
}
