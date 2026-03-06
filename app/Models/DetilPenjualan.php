<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilPenjualan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'jumlah',
        'harga_produk',
        'subtotal',
    ];

    // relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // relasi ke penjualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }
}
