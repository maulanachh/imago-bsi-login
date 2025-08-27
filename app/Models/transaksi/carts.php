<?php

namespace App\Models\transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Models\master\Produk;

class carts extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'tr_carts';
    protected $primaryKey = 'cart_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'produk_id',
        'user_id',
        'qty',
        'harga_satuan',
        'tipediskon_id',
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
}
