<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

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
        $status = new Keranjang();
        $status->where('status', 0)->update([
            'status' => $request->status
        ]);

        $transaksi = new Transaksi([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'harga' => $request->harga
        ]);
        $transaksi->save();

        // foreach ($produk as $kd) {
        $transaksi_detail = new TransaksiDetail([
            'transaksi_id' => $transaksi->id,
            'produk_id' => $request->produk_id,
            'kuantitas' => $request->kuantitas
        ]);
        $transaksi_detail->save();
        // }

        return redirect('/keranjang');
    }
}
