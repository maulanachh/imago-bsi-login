<?php

namespace App\Livewire\Master\KategoriProduk;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\kategoriProduk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KategoriProdukForm extends Component
{
    #[Layout('components.layouts.app')]
    public $katproduk_id;
    public $katproduk_name;
    public $katproduk_desc;
    public function resetForm()
    {
        $this->katproduk_id = null;
        $this->reset();
    }
    public function mount()
    {
        $this->loadData();
    }
    public function create()
    {
        $user = Auth::user();
        $rules = [
            'katproduk_name' => [
                'required',
                Rule::unique('ms_kategori_produk')->ignore($this->katproduk_id, 'katproduk_id')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
        ];
        $this->validate($rules);
        if (session('function') === null) {
            try {
                DB::beginTransaction();
                $create = kategoriProduk::create([
                    'katproduk_name' => $this->katproduk_name,
                    'katproduk_desc' => $this->katproduk_desc,
                    'created_by' => $user->user_id,
                ]);
                DB::commit();
                $this->dispatch('resetForm', [
                    'type' => 'success', // atau 'error' sesuai kebutuhan
                    'message' => "kategori produk {$this->katproduk_name} berhasil dibuat."
                ]);
                $this->resetForm();
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                $this->dispatch('notifikasi', [
                    'type' => 'error',
                    'message' => "Terjadi kesalahan: " . $e->getMessage()
                ]);
            }
        } else {
            try {
                DB::beginTransaction();
                $update = kategoriProduk::where('katproduk_id', $this->katproduk_id)->update([
                    'katproduk_name' => $this->katproduk_name,
                    'katproduk_desc' => $this->katproduk_desc,
                    'updated_by' => $user->user_id,
                ]);
                DB::commit();
                $this->dispatch('resetForm', [
                    'type' => 'success', // atau 'error' sesuai kebutuhan
                    'message' => "kategori produk {$this->katproduk_name} berhasil diupdate."
                ]);
                $this->resetForm();
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                DB::rollBack();

                $this->dispatch('notifikasi', [
                    'type' => 'error',
                    'message' => "Terjadi kesalahan: " . $e->getMessage()
                ]);
            }
        }
    }
    public function loadData()
    {
        $this->katproduk_id = session('katproduk_id');
        if ($this->katproduk_id) {
            $data = kategoriProduk::find($this->katproduk_id);
            if ($data) {
                $this->katproduk_name = $data->katproduk_name;
                $this->katproduk_desc = $data->katproduk_desc;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['katproduk_id', 'function']);
        return redirect()->to('/master/ops/kategoriproduk');
    }
    public function render()
    {
        return view('livewire.master.kategori-produk.kategori-produk-form');
    }
}
