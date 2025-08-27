<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class pendidikan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'ms_pendidikan';
    protected $primaryKey = 'pendidikan_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'pendidikan_name',
    ];
}
