<?php

use App\Models\Whislist;
use App\Models\Keranjang;


if (!function_exists('cekProduk')) {
    function cekProduk($user_id, $produk_id)
    {
        $favorit = Whislist::where(['user_id' => $user_id, 'produk_id' => $produk_id])->first();
        if ($favorit) {
            return 'remove';
        } else {
            return 'favorit';
        }
    }
}

if (!function_exists('getHarga')) {
    function getHarga()
    {
        $totalHarga = 0;
        $diskon = 0;
        $keranjangItems = Keranjang::with('user', 'produk')->where(['user_id' =>  auth()->user()->id, 'status' => 0])->get();
        foreach ($keranjangItems as $item) {
            $totalHarga += $item->kuantitas * $item->produk->harga;
            $diskon = $item->diskon;
        }
        $total_harga = $totalHarga - ($diskon * $totalHarga);

        return $total_harga;
    }
}
