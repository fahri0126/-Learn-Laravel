<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class DashboardProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::latest('id', 'desc')->cari(request(['pencarian', 'kategori']));
        return view('dashboard.produk.index', ['produk' => $produk->paginate(10)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Produk::with('kategori')->get();
        $unit = Produk::with('unit')->get();
        return view('dashboard.produk.create', ['kategori' => $kategori->groupBy('kategori_id'), 'unit' => $unit->groupBy('unit_id')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama' => 'required|unique:produks',
            'kategori_id' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'unit_id' => 'required',
        ]);

        Produk::create($validated);

        return redirect('/dashboard/produk')->with('berhasil', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {

        return view('dashboard.produk.show', ['produk' => $produk]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        Produk::destroy($produk->id);
        return redirect('/dashboard/produk')->with('berhasil', 'Data berhasil dihapus');
    }
}
