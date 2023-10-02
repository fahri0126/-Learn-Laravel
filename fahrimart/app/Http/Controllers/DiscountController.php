<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function discountView()
    {
        $diskon = Discount::all();
        return view('dashboard.diskon.index', compact('diskon'));
    }

    public function addDiscount(Request $request)
    {
        Discount::create([
            'price' => $request->harga,
            'discount' => $request->diskon / 100
        ]);

        return redirect('/dashboard/discount')->with('success', 'Diskon di tambahkan');
    }
    public function getPrice()
    {
        $prices = Discount::all()->pluck('price')->toArray();

        $totalHarga = 0;
        $diskon = 0;

        $keranjangItems = Keranjang::with('user', 'produk')->where(['user_id' =>  auth()->user()->id, 'status' => 0])->get();
        foreach ($keranjangItems as $item) {
            $totalHarga += $item->kuantitas * $item->produk->harga;
            $diskon = $item->diskon;
        }
        $total_harga = $totalHarga - ($diskon * $totalHarga);

        return response()->json(['price' => $prices, 'totalHarga' => $total_harga]);
    }
}
