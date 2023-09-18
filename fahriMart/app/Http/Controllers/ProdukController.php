<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['kategori', 'unit'])->latest('id', 'desc')->cari(request(['pencarian', 'kategori']));
        return view('produk', ['halaman' => 'Produk', 'aksi' => '/produk', 'produk' => $produk->paginate(8)->withQueryString()]);
    }

    public function detail($produkid)
    {
        $produk = Produk::with(['kategori', 'unit'])->where(['nama' => $produkid])->get();

        foreach ($produk as $key => $value) {
            $halaman = $value->nama;
        }

        $shareButtons = \Share::page(
            'https://laravel10.test',
            'Your share text comes here',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();

        return view('produk-detail', ['halaman' => $halaman, 'produk' => $produk, 'shareButtons' => $shareButtons]);
    }

    // public function show($id, $kategori)
    // {
    //     $post = Produk::show($kategori)->get();
    //     // $post = Produk::where('kategori_id', $kategori)->get();
    //     return view('item', ['post' => $post]);
    // }
}
