<?php

namespace App\Http\Controllers;

use App\Models\Whislist;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\While_;

class WhislistController extends Controller
{
    public function index()
    {
        $whislist = Whislist::all();
        return view('whislist', ['whislist' => $whislist]);
    }

    public function store(Request $request)
    {
        Whislist::create([
            'produk_id' => $request->prdId,
            'user_id' => auth()->user()->id
        ]);
    }
}
