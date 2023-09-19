<?php

use App\Models\Discount;
use App\Models\Whislist;

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

if (!function_exists('cekDiskon')) {
    function cekDiskon($total_price)
    {
        $diskon = new Discount();
        if ($total_price >= $diskon->price) {
            return 'diskon';
        } else {
            return 'tidak ada diskon';
        }
    }
}
