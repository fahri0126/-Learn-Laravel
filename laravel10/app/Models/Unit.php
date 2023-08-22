<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function scopeCari($query, array $cari)
    {
        $query->when($cari['pencarian'] ?? false, function ($query, $pencarian) {
            $query->where('nama', 'like', '%' . $pencarian . '%');
        });

        return $query;
    }
}
