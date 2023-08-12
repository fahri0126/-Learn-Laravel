<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // protected $fillable = ['nama', 'kategori_id', 'pesans_id', 'harga'];

    protected $guarded = ['id'];

    public function  scopeShow($query, $kategori)
    {
        $query->where('kategori_id', $kategori);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }


    // // nama tabel
    // protected $table = 'produks';
    // // id tabel
    // protected $primaryKey = 'id';
    // // autoincrement id
    // public $incrementing = true;
    // // tipe data id
    // protected $keyType = 'integer';
    // // timestamp
    // public $timestamps = true;
}
