<?php

namespace App\Livewire\Master\Produk;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\kategoriProduk;
use App\Models\master\Produk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdukForm extends Component
{
    use WithFileUploads;
    #[Layout('components.layouts.app')]
    public $produk_id;
    public $katproduk_id;
    public $produk_name;
    public $berat_produk;
    public $produk_url;
    public $old_produk_url;
    public $about_produk;
    public $satuan_id;
    public $produk_utama;
    public $kategori_produk = [];
    public $satuan_berat = [];

    public function resetForm()
    {
        $this->produk_id = null;
        $this->reset();
        $this->selectKategoriProduk();
        $this->selectSatuanBerat();
    }
    public function mount()
    {
        $this->loadData();
        $this->selectKategoriProduk();
        $this->selectSatuanBerat();
    }
    public function selectKategoriProduk()
    {
        $this->kategori_produk = DB::table('ms_kategori_produk')
            ->where('deleted_at', null)->pluck('katproduk_name', 'katproduk_id');
    }
    public function selectSatuanBerat()
    {
        $this->satuan_berat = DB::table('ms_satuan_berat_produk')
            ->where('deleted_at', null)->pluck('satuan_name', 'satuan_id');
    }
    protected function handleImageUpload()
    {

        try {
            if ($this->produk_url && is_object($this->produk_url)) {
                // Validasi file
                $this->validate([
                    'produk_url' => 'image|max:2048'
                ]);

                // Delete old image if exists
                if ($this->old_produk_url && Storage::exists('public/' . $this->old_produk_url)) {
                    Storage::delete('public/' . $this->old_produk_url);
                }

                // Store new image
                $path = $this->produk_url->store('products', 'public');
                if (empty($path)) {
                    throw new \Exception('Gagal mengupload gambar: Path kosong');
                }
                return $path;
            }

            return $this->old_produk_url;
        } catch (\Exception $e) {
            throw new \Exception('Gagal mengupload gambar: ' . $e->getMessage());
        }
    }
    public function create()
    {
        $user = Auth::user();

        $rules = [
            'produk_name' => [
                'required',
                Rule::unique('ms_produk')->ignore($this->produk_id, 'produk_id')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'katproduk_id' => ['required'],
            'satuan_id' => ['required'],
            'berat_produk' => ['required'],
            // 'produk_url' => [
            //     'nullable',
            //     'image',
            //     'max:2048'
            // ]
        ];

        try {
            $this->validate($rules);

            DB::beginTransaction();

            if (session('function') === null) {
                $imagePath = $this->handleImageUpload();

                Produk::create([
                    'katproduk_id' => $this->katproduk_id,
                    'produk_name' => $this->produk_name,
                    'satuan_id' => $this->satuan_id,
                    'berat_produk' => $this->berat_produk,
                    'produk_utama' => $this->produk_utama,
                    'produk_url' => $imagePath,
                    'about_produk' => $this->about_produk,
                    'created_by' => $user->user_id,
                ]);

                $message = "Produk {$this->produk_name} berhasil dibuat.";
            } else {
                $imagePath = $this->handleImageUpload();

                $dataToUpdate = [
                    'katproduk_id' => $this->katproduk_id,
                    'produk_name' => $this->produk_name,
                    'satuan_id' => $this->satuan_id,
                    'berat_produk' => $this->berat_produk,
                    'produk_utama' => $this->produk_utama,
                    'about_produk' => $this->about_produk,
                    'updated_by' => $user->user_id,
                ];

                if ($imagePath !== null) {
                    $dataToUpdate['produk_url'] = $imagePath;
                }

                Produk::where('produk_id', $this->produk_id)->update($dataToUpdate);

                $message = "Produk {$this->produk_name} berhasil diupdate.";
            }

            DB::commit();

            $this->dispatch('notifikasi', [
                'type' => 'success',
                'message' => $message
            ]);

            $this->resetForm();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notifikasi', [
                'type' => 'error',
                'message' => "Terjadi kesalahan: " . $e->getMessage()
            ]);
        }
    }
    public function loadData()
    {
        $this->produk_id = session('produk_id');
        if ($this->produk_id) {
            $data = Produk::find($this->produk_id);
            if ($data) {
                $this->produk_name = $data->produk_name;
                $this->katproduk_id = $data->katproduk_id;
                $this->satuan_id = $data->satuan_id;
                $this->berat_produk = $data->berat_produk;
                $this->old_produk_url = $data->produk_url;
                $this->produk_url = $data->produk_url;
                $this->about_produk = $data->about_produk;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['produk_id', 'function']);
        return redirect()->to('/master/ops/produk');
    }
    public function render()
    {
        return view('livewire.master.produk.produk-form');
    }
}
