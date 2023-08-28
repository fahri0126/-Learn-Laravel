@extends('layouts.template')

@section('landing')
<div class="container mt-3">
    @foreach ($transaksi as $data)
    <div class="col-md-12 my-1">
        <div class="h-55 p-2 bg-body-tertiary border rounded-3 d-flex justify-content-evenly">
            <div class="col ms-3 pt-1 align-items-center lh-base">
                <div class="row">
                    {{-- <p>Nama Lengkap : {{ auth()->user()->name }}</p> --}}
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex gap-5">
                        {{-- <p class="">Username : {{ auth()->user()->username }}</p> --}}
                        <p class="">{{ $data->date }}</p>
                        <p class="">Total harga : <span class="text-danger">Rp. {{ number_format($data->harga) }}</span></p>
                        <div class="ms-auto">
                        <form action="/keranjang/transaksi/detail/store" method="post">
                            @csrf
                            <button href="/keranjang/transaksi/detail" class="text-info btn">detail</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endforeach
</div>
@endsection