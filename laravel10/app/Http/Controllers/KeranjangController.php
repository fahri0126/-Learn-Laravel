<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class KeranjangController extends Controller
{
    public function index()
    {
        $produk = Keranjang::all();
        return view('keranjang', ['halaman' => 'Keranjang', 'produk' => $produk]);
    }

    public function store(Request $request, $id)
    {
        $existingKeranjang = Keranjang::where('produk_id', $request->produk_id)->first();

        if ($existingKeranjang) {
            $existingKeranjang->date = $request->date;
            $existingKeranjang->user_id = $request->user_id;
            $existingKeranjang->produk_id = $request->produk_id;
            $existingKeranjang->kuantitas = $request->kuantitas;
            $existingKeranjang->update();
        } else {
            $newKeranjang = new Keranjang();
            $newKeranjang->fill($request->all());
            // $newKeranjang->date = $request->date;
            // $newKeranjang->user_id = $request->user_id;
            // $newKeranjang->produk_id = $request->produk_id;
            // $newKeranjang->kuantitas = $request->kuantitas;
            $newKeranjang->save();
        }
    }
}
