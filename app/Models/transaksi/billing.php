<?php

namespace App\Models\transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Models\master\Produk;
use App\Models\transaksi\billingDetail;

class billing extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'tr_billing';
    protected $primaryKey = 'billing_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'no_invoice',
        'user_id',
        'referral_id',
        'subtotal_harga',
        'diskon',
        'diskon_total_billing',
        'total_harga',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function details()
    {
        return $this->hasMany(billingDetail::class, 'billing_id', 'billing_id');
    }

    protected static function booted()
    {
        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
            $model->save();
        });
    }
}
