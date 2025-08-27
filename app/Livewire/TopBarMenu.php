<?php

namespace App\Livewire;

use Livewire\Component;
use Symfony\Component\HttpFoundation\Request;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class TopBarMenu extends Component
{
    public $username;
    public $features = [];
    public $feature_id;
    public $breadcrumbs = [];
    public function mount()
    {
        if (Auth::check()) {
            $this->feature_id = session('feature_id');
            $this->username = Auth::user()->user_name;
            $this->features = $this->getRoleFeatures();
        } else {
            return redirect()->route('login');
        }
    }
    public function getRoleFeatures()
    {
        $user = Auth::user();
        $role = DB::table('user_roles')
            ->where('user_role_user_id', $user->user_id)
            ->WhereNull('deleted_at')
            ->first();
        if ($role) {
            $sideBarId = session('side_bar_id');

            $features = DB::table('role_features')
                ->select('role_features.role_feature_feature_id', 'features.feature_name', 'features.feature_route_link', 'features.feature_icon')
                ->join('features', 'role_features.role_feature_feature_id', '=', 'features.feature_id')
                ->where('role_features.role_feature_role_id', $role->user_role_role_id)
                ->where('features.is_parent', '1')
                ->where('features.is_active', '1')
                ->where('features.feature_feature_location_id', '2')
                ->where('role_features.is_active', '1')
                ->WhereNull('role_features.deleted_at')
                ->where('features.feature_side_bar_id', $sideBarId)
                ->groupBy('role_features.role_feature_feature_id')
                ->orderBy('level', 'asc')
                ->get();
            foreach ($features as $feature) {
                $feature->children = DB::table('role_features')
                    ->select('role_features.role_feature_feature_id', 'features.feature_name', 'features.feature_route_link', 'features.feature_icon')
                    ->join('features', 'role_features.role_feature_feature_id', '=', 'features.feature_id')
                    ->where('features.feature_parent_id', $feature->role_feature_feature_id)
                    ->where('features.feature_side_bar_id', $sideBarId)
                    ->where('role_features.role_feature_role_id', $role->user_role_role_id)
                    ->whereNotNull('feature_parent_id')
                    ->where('features.is_active', '1')
                    ->where('role_features.is_active', '1')
                    ->where('features.feature_feature_location_id', '2')
                    ->WhereNull('role_features.deleted_at')
                    ->orderBy('level', 'asc')
                    ->groupBy('role_features.role_feature_feature_id')
                    ->get();
                //Log::debug('Features:', $feature->children->toArray());
            }
            return $features->toArray();
        }

        return [];
    }





    public function resetTopbar()
    {
        session()->forget('parent_feature_id');
        $this->features = $this->getRoleFeatures();
    }
    public function navigateTo($url)
    {
        $feature = DB::table('features')
            ->select('feature_id', 'feature_parent_id', 'feature_side_bar_id')
            ->where('feature_route_link', $url)
            ->first();
        if ($feature) {
            // Simpan `feature_id` dan `side_bar_id`
            session()->put('feature_id', $feature->feature_id);
            session()->put('side_bar_id', $feature->feature_side_bar_id);

            // Atur ulang parent_feature_id jika menu yang diklik bukan child
            if (is_null($feature->feature_parent_id)) {
                session()->forget('parent_feature_id');
            } else {
                session()->put('parent_feature_id', $feature->feature_parent_id);
            }
            $this->dispatch('updateBreadcrumb', $feature->feature_id);
            // Perbarui fitur topbar berdasarkan data baru
            $this->features = $this->getRoleFeatures();

            // Redirect ke URL tujuan
            return $this->redirect($url);
        }
    }






    public function render()
    {
        if (!session()->has('side_bar_id') || !session()->has('feature_id')) {
            $this->resetTopbar();
        }

        return view('components.layouts.topbar-menu', [
            'features' => $this->features,
        ]);
    }
}
