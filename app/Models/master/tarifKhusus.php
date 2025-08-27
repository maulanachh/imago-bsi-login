<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class tarifKhusus extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_tarif_khusus_kmr';
    protected $primaryKey = 'trkhusus_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'klskmr_id',
        'trkhusus_fullday',
        'trkhusus_halfday',
        'tanggal_awal',
        'tanggal_akhir',
        'keterangan',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
