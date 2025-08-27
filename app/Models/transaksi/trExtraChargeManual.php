<?php

namespace App\Models\transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class trExtraChargeManual extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'tr_bill_extracharge_manual';
    protected $primaryKey = 'billextrachargemanual_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'rsv_id',
        'charge_id',
        'tarif',
        'keterangan',
        'sttsbill_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
