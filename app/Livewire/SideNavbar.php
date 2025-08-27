<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use navigate;

class SideNavbar extends Component
{
    #[Layout('layouts.app')]
    public $username;
    public $features = [];
    public $feature_id;
    public function mount()
    {
        $this->username = Auth::user()->name;
        $this->features = $this->getRoleFeatures();
    }

    public function getRoleFeatures()
    {
        $user = Auth::user();

        // Ambil role user
        $role = DB::table('user_roles')
            ->where('user_role_user_id', $user->user_id)
            ->WhereNull('deleted_at')
            ->first();
        if ($role) {
            // Ambil fitur/menu berdasarkan role
            $features = DB::table('role_features')
                ->select('role_features.role_feature_feature_id', 'features.feature_name', 'features.feature_route_link', 'features.feature_icon')
                ->join('features', 'role_features.role_feature_feature_id', '=', 'features.feature_id')
                ->where('role_features.role_feature_role_id', $role->user_role_role_id)
                ->where('features.is_parent', '1')
                ->where('features.is_active', '1')
                ->where('features.feature_feature_location_id', '1')
                ->where('role_features.is_active', '1')
                ->orderBy('level', 'asc')
                ->groupBy('role_features.role_feature_feature_id')
                ->get();
            // Mengisi child features ke masing-masing fitur utama
            foreach ($features as $feature) {
                // Ambil child features untuk setiap fitur utama
                $feature->children = DB::table('role_features')
                    ->select('role_features.role_feature_feature_id', 'features.feature_name', 'features.feature_route_link', 'features.feature_icon')
                    ->join('features', 'role_features.role_feature_feature_id', '=', 'features.feature_id')
                    ->where('features.feature_parent_id', $feature->role_feature_feature_id)
                    ->where('role_features.role_feature_role_id', $role->user_role_role_id)
                    ->whereNotNull('feature_parent_id')
                    ->where('features.is_active', '1')
                    ->where('role_features.is_active', '1')
                    ->orderBy('level', 'asc')
                    ->groupBy('role_features.role_feature_feature_id')
                    ->get();
            }

            return $features->toArray();
        }
        return [];
    }
    public function navigateTo($url)
    {
        $feature = DB::table('features')
            ->select('feature_id', 'feature_parent_id', 'feature_side_bar_id', 'is_parent')
            ->where('feature_route_link', $url)
            ->first();

        if ($feature) {
            // Simpan feature_id dan side_bar_id
            session()->put('feature_id', $feature->feature_id);
            session()->put('side_bar_id', $feature->feature_side_bar_id);

            // Atur ulang parent_feature_id jika diperlukan
            if (is_null($feature->is_parent)) {
                session()->forget('parent_feature_id');
            } else {
                session()->put('parent_feature_id', $feature->feature_parent_id);
            }
            $this->dispatch('updateBreadcrumb', $feature->feature_id);

            // Redirect ke URL tujuan
            return $this->redirect($url);
        }
    }

    public function render()
    {
        if (empty($this->features)) {
            $this->features = $this->getRoleFeatures();
        }
        return view('components.layouts.side-navbar', [
            'features' => $this->features
        ]);
    }
}
