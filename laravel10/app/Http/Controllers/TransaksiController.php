<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use PHPUnit\Event\Tracer\Tracer;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::latest('id', 'desc')->where('user_id', auth()->user()->id);
        return view('transaksi.index', ['halaman' => 'Transaksi', 'transaksi' => $transaksi->get()]);
    }

    public function detail($id)
    {
        $transaksi = TransaksiDetail::with(['transaksi', 'produk'])->where('transaksi_id', $id);
        return view('transaksi.detail', ['halaman' => 'Detail Transaksi', 'detail' => $transaksi->get()]);
    }
}
