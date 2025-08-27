<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class jenisFnb extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_jenisfnb';
    protected $primaryKey = 'jenisfnb_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'jenisfnb_name',
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
