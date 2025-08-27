<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class fasilitasKelasKamar extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_fasilitas_kelas_kmr';
    protected $primaryKey = 'fsklskmr_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'klskmr_id',
        'faskmr_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
