@extends('layouts.template')

@section('landing')

<div class="container">
    @if (count($detail))
    <table class="table border mt-5">
        <thead>
            <th>No</th>
            <th>Produk ID</th>
            <th>Nama Produk</th>
            <th>Kuantitas</th>
            <th>Produk Harga</th>
            <th>Sub Total</th>
        </thead>
        @foreach ($detail as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->produk->id }}</td>
            <td>{{ $data->produk->nama }}</td>
            <td>{{ $data->kuantitas }}</td>
            <td>Rp. {{ number_format($data->produk->harga) }}</td>
            <td>Rp. {{ number_format($data->produk->harga * $data->kuantitas) }}</td>
        </tr>
        @endforeach
        <tr>
            <td>Total Harga : </td>
            <td class="text-danger">Rp. {{ number_format($data->transaksi->harga) }}</td>
        </tr>
    </table>
    @else
    <div class="container d-flex align-items-end justify-content-center" style="height: 40vh">
                <h5 class="text-secondary">there is no item</h5>
            </div>
    @endif
</div>

@endsection