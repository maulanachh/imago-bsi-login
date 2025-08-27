<?php

namespace App\Models\transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class rsvLangsung extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'tr_reservasi_kmr';
    protected $primaryKey = 'rsv_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'booking_id',
        'cus_id',
        'kamar_id',
        'rekanan_id',
        'aslbooking_id',
        'no_referensi',
        'jumlah_tamu',
        'tanggal_checkin',
        'tanggal_checkout',
        'sttsrsv_id',
        'tipeinap_id',
        'tarif_kamar',
        'asaltrf_id',
        'asal_tarif',
        'total_malam',
        'total_tarif_kamar',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
