<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{

    protected $fillable = ['date', 'user_id', 'produk_id', 'kuantitas'];

    use HasFactory;

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
