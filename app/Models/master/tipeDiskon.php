<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class tipeDiskon extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_tipe_diskon';
    protected $primaryKey = 'tipediskon_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'tipediskon_name',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
