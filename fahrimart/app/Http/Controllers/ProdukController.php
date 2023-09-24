<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['kategori', 'unit', 'gambar'])->latest('id', 'desc')->cari(request(['pencarian', 'kategori']));
        return view('produk', ['halaman' => 'Produk', 'aksi' => '/produk', 'produk' => $produk->paginate(8)->withQueryString()]);
    }

    public function detail($prdName, $id)
    {
        $produk = Produk::with(['kategori', 'unit', 'gambar'])->where(['id' => $id])->get();

        foreach ($produk as $key => $value) {
            $halaman = $value->nama;
        }

        return view('produk-detail', ['halaman' => $halaman, 'produk' => $produk]);
    }
}
