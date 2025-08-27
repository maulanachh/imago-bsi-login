<?php

namespace App\Models\master;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Models\master\hargaProduk;

class Produk extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ms_produk';
    protected $primaryKey = 'produk_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'katproduk_id',
        'produk_name',
        'berat_produk',
        'produk_name',
        'produk_utama',
        'satuan',
        'about_produk',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    public function hargaProduk()
    {
        return $this->hasOne(hargaProduk::class, 'produk_id', 'produk_id');
    }
    protected static function booted()
    {
        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
            $model->save();
        });
    }
}
