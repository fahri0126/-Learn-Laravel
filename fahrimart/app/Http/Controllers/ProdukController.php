<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdukResource;
use App\Models\Gambar;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['kategori', 'unit', 'gambar'])->latest('id', 'desc')->cari(request(['pencarian', 'kategori']))->paginate(8)->withQueryString();
        return view('produk', ['halaman' => 'Produk', 'aksi' => '/produk', 'produk' => $produk]);
        // return response()->json(['halaman' => 'Produk', 'aksi' => '/produk', 'produk' => $produk]);
        // return ProdukResource::collection(['halaman' => 'Produk', 'aksi' => '/produk', 'produk' => $produk]);
    }

    public function detail($prdName)
    {
        $produk = Produk::with(['kategori', 'unit', 'gambar'])->where(['nama' => $prdName])->get();

        foreach ($produk as $key => $value) {
            $halaman = $value->nama;
        }

        return view('produk-detail', ['halaman' => $halaman, 'produk' => $produk]);
    }
}
