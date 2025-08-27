<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class rolegroupFeature extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'role_features';
    protected $primaryKey = 'role_feature_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'role_feature_feature_id',
        'role_feature_role_id',
        'is_active',
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
