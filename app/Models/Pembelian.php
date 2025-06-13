<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pembeli',
        'stok_beli',
        'harga_beli',
        'product_id',
        'total_bayar',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
