<?php

namespace App\Livewire\Setting\Developer;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\feature;
use Illuminate\Validation\Rule;

class FeatureForm extends Component
{
    #[Layout('components.layouts.app')]
    public $feature_id;
    public $feature_code;
    public $feature_name;
    public $is_parent;
    public $feature_location_id;
    public $feature_side_bar_id;
    public $feature_parent_id;
    public $level;
    public $feature_route_link;
    public $feature_icon;
    public $feature_location_name;
    public $feature_side_bar_name;
    public $feature_parent_name;
    public function mount()
    {
        $this->loadFeature();
    }
    public function resetForm()
    {
        $this->feature_id = null;
        $this->reset();
    }
    public function createFeature()
    {
        $user = Auth::user();
        $rules = [
            'feature_location_id' => ['required'],
            'level' => ['required'],
            'feature_route_link' => ['required'],
            'feature_icon' => ['required']
        ];
        if (session('function') === null) {
            $rules['feature_code'] = ['required', 'min:4', Rule::unique('features', 'feature_code')->whereNull('deleted_at')];
            $rules['feature_name'] = ['required', 'min:4', Rule::unique('features', 'feature_name')->whereNull('deleted_at')];
        } else if ($this->is_parent && $this->feature_location_id == 1) {
            $rules['feature_parent_id'] = ['nullable'];
            $rules['feature_side_bar_id'] = ['nullable'];
        }
        $this->validate($rules);

        $parent = $this->is_parent ? 1 : null;
        if (session('function') === null) {
            $feature_create =  feature::create([
                'feature_id' => $this->feature_id,
                'feature_code' => $this->feature_code,
                'feature_name' => $this->feature_name,
                'is_parent' => $parent,
                'feature_feature_location_id' => $this->feature_location_id,
                'feature_side_bar_id' => $this->feature_side_bar_id,
                'feature_parent_id' => $this->feature_parent_id,
                'level' => $this->level,
                'is_active' => 1,
                'feature_route_link' => $this->feature_route_link,
                'feature_icon' => $this->feature_icon,
                'created_by' => $user->user_id
            ]);
            if ($this->is_parent && $this->feature_location_id == 1) {
                $feature_create->update([
                    'feature_side_bar_id' => $feature_create->feature_id,
                    'feature_parent_id' => null
                ]);
            } else if ($this->is_parent && $this->feature_location_id == 2) {
                $feature_create->update([
                    'feature_side_bar_id' => $this->feature_side_bar_id,
                    'feature_parent_id' => $this->feature_side_bar_id,
                    'feature_route_link' => null,
                ]);
            }
            $this->dispatch('resetForm', "Fitur {$this->feature_name} berhasil dibuat.");
            $this->resetForm();
        } else {
            $feature_update = feature::find($this->feature_id);
            if ($feature_update) {
                $feature_update->update([
                    'feature_code' => $this->feature_code,
                    'feature_name' => $this->feature_name,
                    'is_parent' => $parent,
                    'feature_feature_location_id' => $this->feature_location_id,
                    'feature_side_bar_id' => $this->feature_side_bar_id,
                    'feature_parent_id' => $this->feature_parent_id,
                    'level' => $this->level,
                    'feature_route_link' => $this->feature_route_link,
                    'feature_icon' => $this->feature_icon,
                    'updated_by' => $user->user_id
                ]);
                if ($this->is_parent && $this->feature_location_id == 1) {
                    $feature_update->update([
                        'feature_side_bar_id' => $feature_update->feature_id,
                        'feature_parent_id' => null
                    ]);
                } else if ($this->is_parent && $this->feature_location_id == 2) {
                    $feature_update->update([
                        'feature_side_bar_id' => $this->feature_side_bar_id,
                        'feature_parent_id' => $this->feature_side_bar_id,
                        'feature_route_link' => null,
                    ]);
                }
                $this->dispatch('resetForm', "Fitur {$this->feature_name} berhasil diupdate.");
                $this->resetForm();
            }
        }
    }
    public function loadFeature()
    {
        $this->feature_id = session('feature_id');
        if ($this->feature_id) {
            $feature = DB::table('features')
                ->where('features.feature_id', $this->feature_id)
                ->select(
                    'features.feature_name',
                    'features.feature_code',
                    'features.is_parent',
                    'features.feature_feature_location_id',
                    'features.feature_side_bar_id',
                    'features.feature_parent_id',
                    'features.level',
                    'features.is_active',
                    'features.feature_route_link',
                    'features.feature_icon'
                )
                ->first();
            if ($feature) {
                $this->feature_location_name = DB::table('feature_location')
                    ->where('feature_location_id', $feature->feature_feature_location_id)
                    ->value('feature_location_name');

                $this->feature_side_bar_name = DB::table('features')
                    ->where('feature_id', $feature->feature_side_bar_id)
                    ->value('feature_name');

                $this->feature_parent_name = DB::table('features')
                    ->where('feature_id', $feature->feature_parent_id)
                    ->value('feature_name');
                $parent = $feature->is_parent == 1 ? true : false;
                $this->feature_name = $feature->feature_name;
                $this->feature_code = $feature->feature_code;
                $this->is_parent = $parent;
                $this->feature_location_id = $feature->feature_feature_location_id;
                $this->feature_side_bar_id = $feature->feature_side_bar_id;
                $this->feature_parent_id = $feature->feature_parent_id;
                $this->level = $feature->level;
                $this->feature_route_link = $feature->feature_route_link;
                $this->feature_icon = $feature->feature_icon;

                $this->dispatch('syncSelect2', [
                    'feature_location_id' => $this->feature_location_id,
                    'feature_side_bar_id' => $this->feature_side_bar_id,
                    'feature_parent_id' => $this->feature_parent_id,
                    'level' => $this->level,
                    'feature_location_name' => $this->feature_location_name,
                    'feature_side_bar_name' => $this->feature_side_bar_name,
                    'feature_parent_name' => $this->feature_parent_name,

                ]);
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['feature_id', 'function']);
        return redirect()->to('/setting/developer/masterfitur');
    }
    public function render()
    {
        return view('livewire.setting.developer.feature-form');
    }
}
