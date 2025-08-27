<?php

namespace App\Livewire\Transaksi\Rekruitmen;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\transaksi\rekruitmen;

class ApprovalForm extends Component
{
    #[Layout('components.layouts.app')]
    public $rekruitmen_id;
    public $leader_id;
    public $pekerjaan_id;
    public $jenkel_id;
    public $pendidikan_id;
    public $sttsrekruit_id;
    public $karyawan_name;
    public $tempat_lahir;
    public $tgl_lahir;
    public $phone;
    public $alamat;
    public $jenis_pekerjaan = [];
    public $approval = [];
    public $jenis_kelamin = [];
    public $pendidikan = [];
    public $leader = [];
    public function resetForm()
    {
        $this->rekruitmen_id = null;
        $this->reset();
        $this->selectJenisPekerjaan();
        $this->selectJenisKelamin();
        $this->selectPendidikan();
        $this->selectLeader();
        $this->selectApproval();
    }
    public function mount()
    {
        $this->loadData();
        $this->selectJenisPekerjaan();
        $this->selectJenisKelamin();
        $this->selectPendidikan();
        $this->selectLeader();
        $this->selectApproval();
    }
    public function selectJenisPekerjaan()
    {
        $user = Auth::user();
        $userLevel = DB::table('ms_karyawan')
            ->join('ms_pekerjaan', 'ms_karyawan.pekerjaan_id', '=', 'ms_pekerjaan.pekerjaan_id')
            ->join('users', 'ms_karyawan.karyawan_id', '=', 'users.karyawan_id')
            ->where('ms_karyawan.deleted_at', null)
            ->value('ms_pekerjaan.level');

        $this->jenis_pekerjaan = DB::table('ms_pekerjaan')
            ->where('ms_pekerjaan.deleted_at', null)
            ->pluck('ms_pekerjaan.pekerjaan_name', 'ms_pekerjaan.pekerjaan_id');
    }
    public function updatedPekerjaanId($value)
    {
        $this->selectLeader();
    }
    public function selectLeader()
    {
        $user = Auth::user();
        $this->leader = DB::table('ms_karyawan')
            ->join('users', 'ms_karyawan.karyawan_id', '=', 'users.karyawan_id')
            ->where('ms_karyawan.deleted_at', null)
            ->pluck('ms_karyawan.karyawan_name', 'ms_karyawan.karyawan_id');
    }
    public function selectApproval()
    {
        $user = Auth::user();
        $this->approval = DB::table('ms_stts_rekruitmen')
            ->pluck('sttsrekruit_name', 'sttsrekruit_id');
    }
    public function selectJenisKelamin()
    {
        $this->jenis_kelamin = DB::table('ms_jenis_kelamin')->pluck('kelamin', 'jenkel_id');
    }
    public function selectPendidikan()
    {
        $this->pendidikan = DB::table('ms_pendidikan')->pluck('pendidikan_name', 'pendidikan_id');
    }
    public function create()
    {
        $user = Auth::user();
        $rules = [
            'karyawan_name' => ['required'],
            'pekerjaan_id' => ['required'],
            'jenkel_id' => ['required'],
            'pendidikan_id' => ['required'],
            'tempat_lahir' => ['required'],
            'tgl_lahir' => ['required'],
            'phone' => ['required'],
            'alamat' => ['required'],
        ];
        $this->validate($rules);
        $date_tgl_lahir = Carbon::createFromFormat('d M, Y', $this->tgl_lahir)->format('Y-m-d');
        if (session('function') === null) {
            $karyawan_create = rekruitmen::create([
                'karyawan_name' => $this->karyawan_name,
                'pekerjaan_id' => $this->pekerjaan_id,
                'jenkel_id' => $this->jenkel_id,
                'pendidikan_id' => $this->pendidikan_id,
                'leader_id' => $this->leader_id,
                'tempat_lahir' => $this->tempat_lahir,
                'tgl_lahir' => $date_tgl_lahir,
                'phone' => $this->phone,
                'alamat' => $this->alamat,
                'created_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "pengajuan rekruitmen {$this->karyawan_name} berhasil dibuat."
            ]);
            $this->resetForm();
        } else {
            $karyawan_update = rekruitmen::where('rekruitmen_id', $this->rekruitmen_id)->update([
                'karyawan_name' => $this->karyawan_name,
                'pekerjaan_id' => $this->pekerjaan_id,
                'jenkel_id' => $this->jenkel_id,
                'pendidikan_id' => $this->pendidikan_id,
                'leader_id' => $this->leader_id,
                'sttsrekruit_id' => $this->sttsrekruit_id,
                'tempat_lahir' => $this->tempat_lahir,
                'tgl_lahir' => $date_tgl_lahir,
                'phone' => $this->phone,
                'alamat' => $this->alamat,
                'updated_by' => $user->user_id,
            ]);
            $this->dispatch('resetForm', [
                'type' => 'success', // atau 'error' sesuai kebutuhan
                'message' => "pengajuan rekruitmen {$this->karyawan_name} berhasil diupdate."
            ]);
            $this->resetForm();
        }
    }
    public function loadData()
    {
        $this->rekruitmen_id = session('rekruitmen_id');
        if ($this->rekruitmen_id) {
            $data = rekruitmen::find($this->rekruitmen_id);
            if ($data) {
                $tgl_lahir = Carbon::parse($data->tgl_lahir)->format('d M, Y');
                $this->karyawan_name = $data->karyawan_name;
                $this->pekerjaan_id = $data->pekerjaan_id;
                $this->jenkel_id = $data->jenkel_id;
                $this->pendidikan_id = $data->pendidikan_id;
                $this->sttsrekruit_id = $data->sttsrekruit_id;
                $this->leader_id = $data->leader_id;
                $this->tempat_lahir = $data->tempat_lahir;
                $this->tgl_lahir = $tgl_lahir;
                $this->phone = $data->phone;
                $this->alamat = $data->alamat;
            } else {
                $this->resetForm();
            }
        } else {
            $this->resetForm();
        }
    }
    public function goBack()
    {
        session()->forget(['rekruitmen_id', 'function']);
        return redirect()->to('/transaksi/approval');
    }
    public function render()
    {
        return view('livewire.transaksi.rekruitmen.approval-form');
    }
}
