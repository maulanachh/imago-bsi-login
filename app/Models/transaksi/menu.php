<?php

namespace App\Models\transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class menu extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'tr_bill_fnb';
    protected $primaryKey = 'billfnb_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'rsv_id',
        'fnb_id',
        'booking_id',
        'tarif_satuan',
        'qty',
        'tarif_total',
        'sttsbill_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
