<?php

namespace App\Livewire\Master\Faq;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\master\faq;
use App\Models\master\Produk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FaqForm extends Component
{
    use WithFileUploads;
    #[Layout('components.layouts.app')]
    public $faq_id;
    public $produk_id;
    public $faq_question;
    public $faq_answer;
    public $produk = [];

    public function resetForm()
    {
        $this->faq_id = null;
        $this->reset();
        $this->selectProduk();
    }
    public function mount()
    {
        $this->loadData();
        $this->selectProduk();
    }
    public function selectProduk()
    {
        $this->produk = DB::table('ms_produk')
            ->where('deleted_at', null)->pluck('produk_name', 'produk_id');
    }
    public function create()
    {
        $user = Auth::user();
        $rules = [
            'faq_question' => ['required'],
            'faq_answer' => ['required'],
            'produk_id' => ['required'],
        ];

        try {
            $this->validate($rules);

            DB::beginTransaction();

            if (session('function') === null) {
                faq::create([
                    'produk_id' => $this->produk_id,
                    'faq_question' => $this->faq_question,
                    'faq_answer' => $this->faq_answer,
                    'created_by' => $user->user_id,
                ]);

                $message = "pertanyaan {$this->faq_question} berhasil dibuat.";
            } else {
                faq::where('faq_id', $this->faq_id)->update([
                    'produk_id' => $this->produk_id,
                    'faq_question' => $this->faq_question,
                    'faq_answer' => $this->faq_answer,
                    'updated_by' => $user->user_id,
                ]);

                $message = "pertanyaan {$this->faq_question} berhasil diupdate.";
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
        $this->faq_id = session('faq_id');
        if ($this->faq_id) {
            $data = faq::find($this->faq_id);
            if ($data) {
                $this->produk_id = $data->produk_id;
                $this->faq_question = $data->faq_question;
                $this->faq_answer = $data->faq_answer;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['faq_id', 'function']);
        return redirect()->to('/master/ops/faq');
    }
    public function render()
    {
        return view('livewire.master.faq.faq-form');
    }
}
