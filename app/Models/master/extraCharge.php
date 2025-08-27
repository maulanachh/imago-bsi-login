<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class extraCharge extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_extra_charge';
    protected $primaryKey = 'charge_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'charge_code',
        'charge_name',
        'charge_desc',
        'tarif_charge',
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
