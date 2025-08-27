<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class customers extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_customers';
    protected $primaryKey = 'cus_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'cus_name',
        'cus_address',
        'cus_phone',
        'cus_email',
        'jnsidentity_id',
        'cus_identity_number',
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
