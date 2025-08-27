<?php

namespace App\Livewire\Setting\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\roleGroup;
use App\Models\ACL\user;
use App\Models\master\masterKaryawan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\roleUser;

class UserForm extends Component
{
    #[Layout('components.layouts.app')]
    public $user_id;
    public $role_id;
    public $karyawan_id;
    public $user_name;
    public $password;
    public $confirm_password;
    public $karyawan = [];
    public $roles = [];
    public function resetForm()
    {
        $this->karyawan_id = null;
        $this->reset();
        $this->selectKaryawan();
        $this->selectRoles();
    }
    public function mount()
    {
        $this->loadUser();
        $this->selectKaryawan();
        $this->selectRoles();
    }
    public function selectKaryawan()
    {
        $this->karyawan = DB::table('ms_karyawan')
            ->where('deleted_at', null)->pluck('karyawan_name', 'karyawan_id');
    }
    public function selectRoles()
    {
        $this->roles = DB::table('roles')
            ->where('deleted_at', null)
            ->pluck('role_name', 'role_id');
    }
    public function createUser()
    {
        $user = Auth::user();
        $rules = [
            'role_id' => ['required'],
            'karyawan_id' => [
                'required',
                Rule::unique('users')->ignore($this->user_id, 'user_id')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'user_name' => [
                'required',
                Rule::unique('users')->ignore($this->user_id, 'user_id')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ];
        $this->validate($rules);

        if (session('function') === null) {
            $user_create = user::create([
                'role_id' => $this->role_id,
                'karyawan_id' => $this->karyawan_id,
                'user_name' => $this->user_name,
                'password' => Hash::make($this->password),
                'remember_token' => Str::random(60),
                'created_by' => $user->user_id,
            ]);
            RoleUser::where('user_role_user_id', $user_create->user_id)->delete();

            // Buat role baru
            $roleUser = RoleUser::create([
                'user_role_user_id' => $user_create->user_id,
                'user_role_role_id' => $this->role_id
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "User {$this->user_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $user_update = user::where('user_id', $this->user_id)->update([
                'role_id' => $this->role_id,
                'karyawan_id' => $this->karyawan_id,
                'user_name' => $this->user_name,
                'password' => Hash::make($this->password),
                'remember_token' => Str::random(60),
                'updated_by' => $user->user_id,
            ]);
            RoleUser::where('user_role_user_id', $this->user_id)->delete();

            // Buat role baru
            $roleUser = RoleUser::create([
                'user_role_user_id' => $this->user_id,
                'user_role_role_id' => $this->role_id
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "User {$this->user_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadUser()
    {
        $this->user_id = session('user_id');
        if ($this->user_id) {
            $user = user::find($this->user_id);
            if ($user) {
                $this->role_id = $user->role_id;
                $this->karyawan_id = $user->karyawan_id;
                $this->user_name = $user->user_name;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['user_id', 'function']);
        return redirect()->to('/setting/masteruser/users');
    }
    public function render()
    {
        return view('livewire.setting.user.user-form');
    }
}
