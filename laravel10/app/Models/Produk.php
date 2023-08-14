<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // protected $fillable = ['nama', 'kategori_id', 'pesans_id', 'harga'];

    protected $guarded = ['id'];

    public function scopeCari($query, array $cari)
    {
        $query->when($cari['pencarian'] ?? false, function ($query, $pencarian) {
            return $query->where('nama', 'like', '%' . $pencarian . '%');
        });

        $query->when($cari['kategori'] ?? false, function ($query, $kategori) {
            return $query->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('nama', 'like', '%' . $kategori . '%');
            });
        });
    }


    public function scopeShow($query, $kategori)
    {
        $query->where('kategori_id', $kategori)->orderBy('id', 'desc');
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
