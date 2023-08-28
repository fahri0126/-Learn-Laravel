@extends('layouts.template')

@section('landing')
<div class="container py-4">
    <div class="row">
        @if (count($keranjang))
            @foreach ($keranjang as $data)
            <div class="col-md-6 my-1">
                <div class="h-55 p-2 bg-body-tertiary border rounded-3 d-flex justify-content-evenly">
                    <img class="rounded-3" src="{{ asset('img/sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg') }}" alt=""
                        style="max-height: 8rem">
                    <div class="col ms-3 pt-1 align-items-center lh-base">
                        <div class="lh-1">
                            <p>{{ $data->produk->nama }}</p>
                            <p>{{ ($data->produk->berat * $data->kuantitas) }} {{ $data->produk->unit->nama }}</p>
                        </div>
                        <p class="d-inline text-danger">Rp. {{ number_format($data->produk->harga * $data->kuantitas) }}</p><br>
                        
                        <p class="border d-inline">jumlah pesanan : &nbsp;&nbsp;{{ $data->kuantitas }}&nbsp;&nbsp;</p>
                        <div class="d-flex justify-content-start gap-1 mt-2">
                            <form class="kurang">
                                @csrf
                                <button type="button" class="btn btn-warning badge" onclick="decreaseQuantity(this)">-</button>
                            </form>
                            <form class="tambah">
                                @csrf
                                <button type="button" class="btn btn-warning badge" onclick="increaseQuantity(this)">+</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="container d-flex align-items-end justify-content-center" style="height: 40vh">
                <h5 class="text-secondary">there is no item</h5>
            </div>
        @endif
    </div>
</div>
@php
    $totalHarga = 0;
@endphp

@foreach ($keranjang as $item)
@php
    $totalHarga += $item ->produk->harga * $item->kuantitas;
@endphp
@endforeach

<nav class="navbar fixed-bottom navbar-expand-lg bg-body-tertiary shadow-lg">
  <div class="container">
    <p class="">Total harga : <span class="text-danger">Rp. {{ number_format($totalHarga) }}</span></p>
    <form action="/keranjang/status" method="post">
        @csrf
        @foreach ($keranjang as $kd)
        <input type="hidden" name="status" value="{{ 1 }}">
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="date" value="{{ now()->format('Y-m-d') }}">
        <input type="hidden" name="harga" value="{{ $totalHarga }}">
        <input type="hidden" name="produk_id" value="{{ $kd->produk_id }}">
        <input type="hidden" name="kuantitas" value="{{ $kd->kuantitas }}">
        @endforeach
        <button type="submit" class="rounded-0 ms-auto btn btn-danger" onclick="return confirm('are you sure ?')">Checkout</button>
    </form>
  </div>
</nav>

{{-- @php
    $transaksi = new Transaksi([
        'user_id' => Auth::user()->id,
        'date' => date('Y-m-d')->now(),
        'harga' => $hargaTotal
    ]);
    $transaksi->save();

    @foreach ($keranjang as $kd)
    $transaksi_detail = new TransaksiDetail([
        'transaksi_id' => $transaksi->id,
        'produk_id' => $kd->produk->id,
        'kuantitas' => $kd->produk->kuantitas
    ]);
    $transaksi_detail->save();
    @endforeach

@endphp --}}
@include('partials.perenggang')
@endsection
