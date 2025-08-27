<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class kelasKamar extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_kelas_kmr';
    protected $primaryKey = 'klskmr_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'klskmr_code',
        'klskmr_name',
        'klskmr_desc',
        'tarif_dasar',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
