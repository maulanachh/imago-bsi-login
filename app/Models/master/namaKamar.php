<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class namaKamar extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_kamar';
    protected $primaryKey = 'kamar_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'kamar_code',
        'kamar_name',
        'klskmr_id',
        'jnskmr_id',
        'sttskmr_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
