<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $produk = Keranjang::where('user_id', auth()->user()->id)->get();
        return view('keranjang', ['halaman' => 'Keranjang', 'produk' => $produk]);
    }

    public function store(Request $request)
    {
        $existingKeranjang = Keranjang::where('produk_id', $request->produk_id)->first();

        if ($existingKeranjang) {
            $existingKeranjang->update([
                'kuantitas' => $existingKeranjang->kuantitas + $request->kuantitas
            ]);
        } else {

            // $data = [
            //     'kuantitas' => $request->kuantitas,
            //     'produk_id' => $request->produk_id,
            //     'user_id' => $request->user_id,
            //     'date' => $request->date
            // ];
            // Keranjang::insert($data);

            $newKeranjang = new Keranjang();
            $newKeranjang->fill($request->all());
            $newKeranjang->save();
        }
    }
}
