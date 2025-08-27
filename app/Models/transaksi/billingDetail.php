<?php

namespace App\Models\transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Models\master\Produk;

class billingDetail extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'tr_billing_detail';
    protected $primaryKey = 'billdetail_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'billing_id',
        'user_id',
        'produk_id',
        'tipediskon_id',
        'qty',
        'harga_satuan',
        'diskon',
        'nominal_diskon',
        'subtotal_harga',
        'total_harga',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    protected static function booted()
    {
        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
            $model->save();
        });
    }
}
