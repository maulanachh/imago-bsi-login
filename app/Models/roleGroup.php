<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class roleGroup extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'role_name'
    ];
}
