<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function index()
    {

        return view('transaksi.detail', ['halaman' => 'Detail Trasaksi']);
    }
}
