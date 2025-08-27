<?php

namespace App\Livewire\Setting\RoleFeature;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\rolegroupFeature;
use Illuminate\Support\Carbon;

class RoleFeatureForm extends Component
{
    #[Layout('components.layouts.app')]
    public $role_feature_feature_id;
    public $role_feature_role_id;
    public $role_feature_id;
    public $role_id;
    public $feature_id;
    public $data_role_features;
    public $role = [];
    public $features = [];
    public function resetForm()
    {
        $this->role_feature_role_id = null;
        $this->role_feature_feature_id = null;
        $this->reset();
        $this->selectRole();
        $this->tableRoleFeature();
    }
    public function mount()
    {
        $this->selectRole();
        $this->tableRoleFeature();
        //  $this->updatedRoleId($value = null);
    }
    public function selectRole()
    {
        $this->role = DB::table('roles')->whereNull('deleted_at')->pluck('role_name', 'role_id');
    }
    public function tableRoleFeature()
    {

        $this->data_role_features = rolegroupFeature::query()
            ->join('roles', 'role_features.role_feature_role_id', '=', 'roles.role_id')
            ->join('features', 'role_features.role_feature_feature_id', '=', 'features.feature_id')
            ->where('role_feature_role_id', $this->role_id)
            ->select(
                'role_features.role_feature_id',
                'features.feature_name',
                'roles.role_name',
            )
            ->get();
    }
    public function updatedRoleId($value)
    {
        $this->role_id = null;
        $this->features = [];
        // Ambil tarif dari fasilitas yang dipilih
        $role = DB::table('roles')->where('role_id', $value)->first();
        if ($role) {
            $this->role_id = $role->role_id;
        }
        $this->features = DB::table('features as a')
            ->leftJoin('role_features as b', function ($join) {
                $join->on('a.feature_id', '=', 'b.role_feature_feature_id')
                    ->where('b.role_feature_role_id', '=', $this->role_id)
                    ->whereNull('b.deleted_at');;
            })
            ->whereNull('b.role_feature_feature_id')
            ->whereNull('a.deleted_at')
            ->pluck('feature_name', 'feature_id');
        $this->tableRoleFeature();
    }
    public function createFitur()
    {

        $user = Auth::user();
        $rules = [
            'role_id' => ['required'],
            'feature_id' => ['required'],
        ];
        $this->validate($rules);
        $isDuplicate = rolegroupFeature::where('role_feature_role_id', $this->role_id)
            ->where('role_feature_feature_id', $this->feature_id)
            ->exists();
        if ($isDuplicate) {
            $this->dispatch('resetForm', [
                'type' => 'error', // atau 'error' sesuai kebutuhan
                'message' => "Fitur sudah ada."
            ]);
            return;
        }
        $karyawan_create = rolegroupFeature::create([
            'role_feature_feature_id' => $this->feature_id,
            'role_feature_role_id' => $this->role_id,
            'is_active' => 1,
            'created_by' => $user->user_id,
        ]);
        $this->dispatch('resetForm', [
            'type' => 'success', // atau 'error' sesuai kebutuhan
            'message' => "Fitur berhasil ditambahkan."
        ]);
        $this->tableRoleFeature();
        $this->features = [];
    }
    public function askDelete($role_feature_id)
    {
        $this->role_feature_id = $role_feature_id;
        $this->dispatch('openDeleteModal', [
            'rowId' => $this->role_feature_id
        ]);
    }
    public function confirmRoleGroupFitur()
    {
        $data_rolegroup = rolegroupFeature::find($this->role_feature_id);
        if ($data_rolegroup) {
            $delete_data = $data_rolegroup->delete();
            $this->tableRoleFeature();
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "Fitur berhasil didelete."
            ]);
        } else {
            $this->tableRoleFeature();
            $this->dispatch('resetForm', [
                'type' => 'error', // atau 'error' sesuai kebutuhan
                'message' => "Ada kesalahan, hubungi admin system."
            ]);
            return;
        }
    }
    public function render()
    {
        return view('livewire.setting.role-feature.role-feature-form');
    }
}
