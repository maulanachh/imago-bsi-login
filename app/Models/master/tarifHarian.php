<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class tarifHarian extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_dailyrate_kmr';
    protected $primaryKey = 'dailyrate_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'klskmr_id',
        'day_id',
        'tarif_harian_fullday',
        'tarif_harian_halfday',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
