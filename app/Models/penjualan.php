<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'pelanggan_id',
        'nomor_transaksi',
        'tanggal',
        'total',
        'tunai',
        'kembalian',
        'status',
        'subtotal',
        'pajak'
    ];
    // relasi ke detail penjualan
    public function detilPenjualan()
    {
        return $this->hasMany(DetilPenjualan::class, 'penjualan_id');
    }

    // relasi ke pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    // relasi ke kasir / user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
