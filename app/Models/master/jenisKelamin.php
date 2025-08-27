<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class jenisKelamin extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_jenis_kelamin';
    protected $primaryKey = 'jenkel_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'kelamin',
    ];
}
