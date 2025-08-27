<?php

namespace App\Models\master\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class userRole extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'user_roles';
    protected $primaryKey = 'user_role_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'user_role_user_id',
        'user_role_role_id',
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
