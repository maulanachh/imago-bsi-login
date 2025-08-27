<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;


class Breadcrumb extends Component
{
    public $username;
    public $feature_id;
    public $breadcrumbs = [];

    // Menambahkan listeners untuk mendengarkan event 'updateBreadcrumb'
    protected $listeners = ['updateBreadcrumb' => 'handleUpdateBreadcrumb'];

    public function mount()
    {
        if (Auth::check()) {
            $this->feature_id = session('feature_id');
            $this->username = Auth::user()->user_name;
            $this->breadcrumbs = $this->getBreadcrumb($this->feature_id);
        } else {
            return redirect()->route('login');
        }
    }

    public function handleUpdateBreadcrumb($feature_id)
    {
        // Mengupdate feature_id dan mendapatkan breadcrumb terbaru
        $this->feature_id = $feature_id;
        $this->breadcrumbs = $this->getBreadcrumb($feature_id);
    }

    public function getBreadcrumb($feature_id)
    {
        $breadcrumbs = [];

        while ($feature_id) {
            $feature = DB::table('features')
                ->select('feature_id', 'feature_name', 'feature_route_link', 'feature_parent_id', 'feature_side_bar_id')
                ->where('feature_id', $feature_id)
                ->first();

            if ($feature) {
                $url = $feature->feature_route_link;

                // Jika fitur tidak punya URL, gunakan URL dari sidebar terkait
                if (!$url && $feature->feature_side_bar_id) {
                    $sidebar = DB::table('features')
                        ->select('feature_route_link')
                        ->where('feature_id', $feature->feature_side_bar_id)
                        ->first();

                    $url = $sidebar ? $sidebar->feature_route_link : null;
                }

                $breadcrumbs[] = [
                    'name' => $feature->feature_name,
                    'link' => $url,
                ];

                // Hentikan jika sudah mencapai sidebar root
                if ($feature_id == $feature->feature_side_bar_id) {
                    break;
                }

                // Iterasi ke parent berikutnya
                $feature_id = $feature->feature_parent_id;
            } else {
                break;
            }
        }

        // Reverse array karena breadcrumb dimulai dari parent
        return array_reverse($breadcrumbs);
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
            //$this->features = $this->getRoleFeatures();

            // Redirect ke URL tujuan
            return $this->redirect($url);
        }
    }
    public function render()
    {
        // Menggunakan wire:key untuk memastikan re-render saat feature_id berubah
        return view('livewire.breadcrumb', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }
}
