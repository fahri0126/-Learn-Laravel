<?php

namespace App\Http\Controllers;

use App\Models\Whislist;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\While_;

class WhislistController extends Controller
{
    public function index()
    {
        $whislist = Whislist::where('user_id', auth()->user()->id)->get();
        return view('whislist', ['halaman' => 'Favorit', 'whislist' => $whislist]);
    }

    public function store(Request $request)
    {
        Whislist::create([
            'produk_id' => $request->prdId,
            'user_id' => auth()->user()->id
        ]);
    }

    public function destroy($id)
    {
        Whislist::where(['produk_id' => $id, 'user_id' => auth()->user()->id])->delete();

        $whislist = Whislist::with(['user', 'produk'])->where('user_id', auth()->user()->id)->get();

        $view = view('partials.favorit', ['whislist' => $whislist])->render();

        return response()->json(['html' => $view]);
    }
}
