<?php

namespace App\Livewire\Setting\RoleFeature;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RoleFeatureIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableRoleFeatureLoaded = false;
    public function loadTableRoleFeature()
    {
        $this->isTableRoleFeatureLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createFeature()
    {
        session()->forget(['role_feature_role_id', 'function']);

        $this->redirect('/setting/masteruser/rolefeature/create');
    }
    public function render()
    {
        return view('livewire.setting.role-feature.role-feature-index');
    }
}
