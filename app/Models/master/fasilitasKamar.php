<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class fasilitasKamar extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_fasilitas_kmr';
    protected $primaryKey = 'faskmr_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'faskmr_code',
        'faskmr_name',
        'faskmr_desc',
        'tarif_exc',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
