<?php

namespace App\Models\transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class invoice extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'tr_bill_total';
    protected $primaryKey = 'billtotal_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'rsv_id',
        'no_invoice',
        'total_bill_kmr',
        'total_bill_fasilitas',
        'total_bill_fnb',
        'total_bill_extracharge',
        'total_bill_extracharge_manual',
        'subtotal',
        'tipediskon_id',
        'nominal_pajak',
        'pajak',
        'grand_total',
        'nominal_bayar',
        'nominal_diskon',
        'nominal_diskon_rekanan',
        'bayar_id',
        'bank_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
