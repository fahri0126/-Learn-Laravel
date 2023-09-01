<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;

class KeranjangController extends Controller
{
    public function index()
    {
        $produk = Keranjang::with(['user', 'produk', 'Unit'])->where('user_id', auth()->user()->id)->where('status', 0)->get();
        return view('keranjang', ['halaman' => 'Keranjang', 'keranjang' => $produk]);
    }

    public function store(Request $request)
    {
        $existingKeranjang = Keranjang::where(['produk_id' => $request->produk_id, 'user_id' => $request->user_id, 'status' => 0])->first();

        if ($existingKeranjang) {
            $existingKeranjang->update([
                'kuantitas' => $existingKeranjang->kuantitas + $request->kuantitas
            ]);
        } else {
            $newKeranjang = new Keranjang();
            $newKeranjang->fill($request->all());
            $newKeranjang->save();
        }
    }

    public function status(Request $request)
    {
        // Calculate the total price
        $totalHarga = 0;
        foreach ($request->produk_id as $index => $produk_id) {
            $item = Keranjang::where([
                'produk_id' => $produk_id,
                'user_id' => $request->user_id,
                'status' => 0
            ])->first();
            if ($item) {
                $totalHarga += $item->produk->harga * $request->kuantitas[$index];
            }
        }

        // Create a new transaction with the total price
        $transaksi = new Transaksi([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'harga' => $totalHarga, // Use the calculated total price here
        ]);
        $transaksi->save();

        // Save transaction details
        foreach ($request->produk_id as $index => $produk_id) {
            $transaksi_detail = new TransaksiDetail([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk_id,
                'kuantitas' => $request->kuantitas[$index]
            ]);
            $transaksi_detail->save();
        }

        // Clear the cart
        Keranjang::where('user_id', auth()->user()->id)->where('status', 0)->delete();

        $keranjang = Keranjang::with(['user', 'produk', 'Unit'])
            ->where('user_id', auth()->user()->id)
            ->where('status', 0)
            ->get();

        $view = view('partials.cart', ['keranjang' => $keranjang])->render();

        return response()->json(['html' => $view, 'totalHarga' => $totalHarga]);
    }


    public function updateQuantity(Request $request)
    {
        $productId = $request->product_id;
        $change = $request->change;

        $keranjangItem = Keranjang::where('produk_id', $productId)->where('status', 0)->first();
        $kuantitas = $keranjangItem->kuantitas += $change;
        if ($keranjangItem) {
            if ($kuantitas > 0) {
                $keranjangItem->save();
            } else {
                $keranjangItem->kuantitas = 1;
            }
        }

        return response()->json(['new_quantity' => $keranjangItem->kuantitas]);
    }

    public function getKeranjangCount()
    {
        $keranjangCount = Keranjang::where('user_id', auth()->user()->id)->where('status', 0)->sum('kuantitas');
        return response()->json(['count' => $keranjangCount]);
    }

    public function getHarga()
    {
        $totalHarga = 0;

        $keranjangItems = Keranjang::where('user_id', auth()->user()->id)->where('status', 0)->get();

        foreach ($keranjangItems as $item) {
            $totalHarga += $item->kuantitas * $item->produk->harga;
        }

        return response()->json(['harga' => $totalHarga]);
    }
}
