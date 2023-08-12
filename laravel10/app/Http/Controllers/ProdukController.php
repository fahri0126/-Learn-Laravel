<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('produk', ['produk' => $produk]);
    }

    public function abc($id)
    {
        $post = Produk::where('id', $id)->get();
        return view('tes', ['tes' => $post]);
    }

    public function show($id, $kategori)
    {
        $post = Produk::show($kategori)->get();
        // $post = Produk::where('kategori_id', $kategori)->get();
        return view('item', ['post' => $post]);
    }
}
