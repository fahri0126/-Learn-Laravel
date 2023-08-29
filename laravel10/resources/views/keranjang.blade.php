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
                            <p>{{ $data->produk->berat  }} {{ $data->produk->unit->nama }}</p>
                        </div>
                        <p class="d-inline text-danger">Rp. {{ number_format($data->produk->harga)  }}</p><br>
                        
                        <p class="border d-inline">Jumlah Pesanan : &nbsp;&nbsp;{{ $data->kuantitas }}&nbsp;&nbsp;</p>
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
                <h5 class="text-secondary">the cart is empty</h5>
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
    <form class="check-out-form">
        @csrf
        <input type="hidden" name="status" value="{{ 1 }}">
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="date" value="{{ now() }}">
        <input type="hidden" name="harga" value="{{ $totalHarga }}">
        @foreach ($keranjang as $kd)
        <input type="hidden" name="produk_id[]" value="{{ $kd->produk_id }}">
        <input type="hidden" name="kuantitas[]" value="{{ $kd->kuantitas }}">
        @endforeach
        @if (count($keranjang) == 0 )
        <button type="button" class="ms-auto btn btn-danger disabled"  onclick="store(this)">Checkout</button>
        @else
        <button type="button" class="ms-auto btn btn-danger" onclick="store(this)">Checkout</button>
        @endif
    </form>
  </div>
</nav>


<script>
    function store(button){
        var form = $(button).closest('form');
        var status = form.find("input[name='status']").val();
        var user_id = form.find("input[name='user_id']").val();
        var date = form.find("input[name='date']").val();
        var harga = form.find("input[name='harga']").val();
        var produk_id = form.find("input[name='produk_id[]']").map(function() {
        return $(this).val(); }).get();
        var kuantitas = form.find("input[name='kuantitas[]']").map(function() {
        return $(this).val();}).get();

        $.ajax({
            type: "POST",
            url: "/keranjang/status",
            data: {
                _token: "{{ csrf_token() }}",
                status: status,
                user_id: user_id,
                date: date,
                harga: harga,
                produk_id: produk_id,
                kuantitas: kuantitas
            },
            success: function (response) {
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

</script>


@include('partials.perenggang')
@endsection
