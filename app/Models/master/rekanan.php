<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class rekanan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_rekanan';
    protected $primaryKey = 'rekanan_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'tipediskon_id',
        'rekanan_name',
        'rekanan_desc',
        'persen_diskon',
        'nominal_diskon',
        'rekanan_alamat',
        'rekanan_phone',
        'rekanan_pic',
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
