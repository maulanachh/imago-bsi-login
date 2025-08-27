<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class MasterPekerjaan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_pekerjaan';
    protected $primaryKey = 'pekerjaan_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'pekerjaan_code',
        'pekerjaan_name',
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
