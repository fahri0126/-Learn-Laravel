<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use Illuminate\Http\Request;
use Psy\CodeCleaner\ReturnTypePass;

class UploadImageController extends Controller
{

    public function viewImage($id)
    {
        $prdId = $id;
        $gambar = Gambar::where('produk_id', $prdId)->get();
        return view('dashboard.produk.gambar', compact('prdId', 'gambar'));
    }

    public function postImage(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'string',
            'gambar' => 'required|image|file|max:1024'
        ]);


        if ($request->file('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('product-images');
        }

        Gambar::create($validated);

        return redirect('/dashboard/produk/upload-gambar/' . $request->produk_id)->with('berhasil', 'upload image successfully');
    }

    public function dltImage($prdId, $id)
    {
        Gambar::where(['id' => $id])->delete();

        return redirect('/dashboard/produk/upload-gambar/' . $prdId);
    }
}
