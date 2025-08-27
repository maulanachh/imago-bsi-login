<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class jenisKamar extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_jenis_kmr';
    protected $primaryKey = 'jnskmr_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'jnskmr_code',
        'jnskmr_name',
        'jnskmr_desc',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
