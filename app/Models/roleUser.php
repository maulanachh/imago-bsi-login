<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class roleUser extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'user_roles';
    protected $primaryKey = 'user_role_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'user_role_user_id',
        'user_role_role_id'
    ];
}
