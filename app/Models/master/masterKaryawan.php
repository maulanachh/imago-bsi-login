<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class masterKaryawan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_karyawan';
    protected $primaryKey = 'karyawan_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'pekerjaan_id',
        'jenkel_id',
        'pendidikan_id',
        'leader_id',
        'karyawan_name',
        'tempat_lahir',
        'tgl_lahir',
        'phone',
        'alamat',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    protected static function booted()
    {
        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
            $model->save();
        });
    }
}
