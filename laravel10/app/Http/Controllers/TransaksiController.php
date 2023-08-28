<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use PHPUnit\Event\Tracer\Tracer;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::latest('id', 'desc')->where('user_id', auth()->user()->id);
        return view('transaksi.index', ['halaman' => 'Transaksi', 'transaksi' => $transaksi->get()]);
    }

    public function store(Request $request)
    {
        $transaksi = new Transaksi();
        $transaksi->fill($request->all());
        $transaksi->save();

        return redirect('/keranjang/transaksi');
    }
}
