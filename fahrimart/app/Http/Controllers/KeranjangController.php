<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Discount;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;

class KeranjangController extends Controller
{
    public function index()
    {
        $diskon = Discount::all();
        $produk = Keranjang::with(['user', 'produk', 'Unit'])->where('user_id', auth()->user()->id)->where('status', 0)->get();
        return view('keranjang', ['halaman' => 'Keranjang', 'keranjang' => $produk, 'diskon' => $diskon]);
    }

    public function hold()
    {
        $keranjang = Keranjang::where(['user_id' => auth()->user()->id, 'status' => 0])->get();

        foreach ($keranjang as $item) {
            $kode_transaksi = 'TRX' . date('YmdHis');
            $item->update(['status' => 2, 'kode_transaksi' => $kode_transaksi]);
        }

        $keranjang = Keranjang::with(['user', 'produk', 'unit'])->where('user_id', auth()->user()->id)->where('status', 0)->get();

        $view = view('partials.cart', ['keranjang' => $keranjang])->render();

        return response()->json(['html' => $view]);
    }

    public function unhold(Request $request)
    {
        $keranjang = Keranjang::where(['user_id' => auth()->user()->id, 'kode_transaksi' => $request->kode_transaksi])->get();

        foreach ($keranjang as $item) {
            $item->update(['status' => 0, 'kode_transaksi' => null]);
        }

        $keranjang = Keranjang::with(['user', 'produk', 'unit'])->where(['user_id' => auth()->user()->id, 'status' => 2])->get();

        $view = view('partials.trx', ['keranjang' => $keranjang])->render();

        return response()->json(['html' => $view]);
    }

    public function holdItem()
    {
        $produk = Keranjang::with(['user', 'produk', 'Unit'])->where(['user_id' =>  auth()->user()->id, 'status' => 2])->orderBy('kode_transaksi', 'asc')->get();
        return view('hold', ['halaman' => 'Hold Item', 'keranjang' => $produk]);
    }

    public function dropProduk($id)
    {
        Keranjang::where(['user_id' => auth()->user()->id, 'id' => $id])->delete();

        $keranjang = Keranjang::with(['user', 'produk', 'Unit'])->where('user_id', auth()->user()->id)->where('status', 0)->get();

        $view = view('partials.cart', ['keranjang' => $keranjang])->render();

        return response()->json(['html' => $view]);
    }

    public function checkCart()
    {
        $isEmptyCount = Keranjang::where(['user_id' => auth()->user()->id, 'status' => 0])->count();
        return response()->json(['isEmpty' => $isEmptyCount]);
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

    public function status(Request $request)
    {
        $keranjang = Keranjang::where('status', 0)->get();
        $totalHarga = $keranjang->sum(function ($item) {
            return  $item->produk->harga * $item->kuantitas - ($item->diskon * ($item->produk->harga * $item->kuantitas));
        });

        foreach ($keranjang as $key => $item) {
            $diskon =   $item->diskon;
        }

        $transaksi = new Transaksi([
            'user_id' => auth()->user()->id,
            'date' => now(),
            'harga' => $totalHarga,
            'diskon' => $diskon
        ]);
        $transaksi->save();


        foreach ($keranjang as $item) {
            $transaksi_detail = new TransaksiDetail([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $item->produk_id,
                'kuantitas' => $item->kuantitas
            ]);
            $transaksi_detail->save();
        }

        Keranjang::where('user_id', auth()->user()->id)->where('status', 0)->update(['status' => 1]);

        $keranjang = Keranjang::with(['user', 'produk', 'Unit'])->where('user_id', auth()->user()->id)->where('status', 0)->get();

        $view = view('partials.cart', ['keranjang' => $keranjang])->render();

        return response()->json(['html' => $view, 'totalHarga' => $totalHarga]);
    }

    public function getHarga()
    {
        $totalHarga = 0;
        $diskon = 0;

        $keranjangItems = Keranjang::with('user', 'produk')->where(['user_id' =>  auth()->user()->id, 'status' => 0])->get();

        foreach ($keranjangItems as $item) {
            $totalHarga += $item->kuantitas * $item->produk->harga;
            $diskon = $item->diskon;
        }

        $total_harga = $totalHarga - ($diskon * $totalHarga);

        $getDiskon = '| ' . $diskon * 100 . '% off';

        return response()->json(['harga' => number_format($total_harga), 'diskon' => $getDiskon]);
    }

    public function postHarga($discount)
    {
        $diskon = 0;
        $diskon = $discount;
        $totalHarga = 0;

        $keranjangItems = Keranjang::with('user', 'produk')->where(['user_id' => auth()->user()->id, 'status' => 0])->get();

        foreach ($keranjangItems as $item) {
            $item->update(['diskon' => $diskon]);
        }

        foreach ($keranjangItems as $item) {
            $totalHarga += $item->kuantitas * $item->produk->harga;
        }
        $total_Harga = $totalHarga - ($diskon * $totalHarga);

        $getDiskon = '| ' . $diskon * 100 . '% off';

        return response()->json(['harga' => number_format($total_Harga), 'diskon' => $getDiskon]);
    }

    public function deletediskon()
    {
        $diskon = 0;
        $totalHarga = 0;

        $keranjangItems = Keranjang::with('user', 'produk')->where(['user_id' => auth()->user()->id, 'status' => 0])->get();

        foreach ($keranjangItems as $item) {
            $item->update(['diskon' => $diskon]);
        }

        foreach ($keranjangItems as $item) {
            $totalHarga += $item->kuantitas * $item->produk->harga;
        }
        $total_Harga = $totalHarga - ($diskon * $totalHarga);

        $getDiskon = '| ' . $diskon * 100 . '% off';

        return response()->json(['harga' => number_format($total_Harga), 'diskon' => $getDiskon]);
    }
}
