<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use Carbon\Carbon;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['kategori', 'unit'])->latest('id', 'desc')->cari(request(['pencarian', 'kategori']));
        return view('produk', ['halaman' => 'Produk', 'aksi' => '/produk', 'produk' => $produk->paginate(8)->withQueryString()]);
    }

    public function keranjang($id)
    {
    }

    // public function show($id, $kategori)
    // {
    //     $post = Produk::show($kategori)->get();
    //     // $post = Produk::where('kategori_id', $kategori)->get();
    //     return view('item', ['post' => $post]);
    // }
}
