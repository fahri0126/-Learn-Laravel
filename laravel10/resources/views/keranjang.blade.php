@extends('layouts.template')

@section('landing')


  <div class="container py-4">
    <div class="row">

      @if (count($produk))

      @foreach ( $produk as $data)
      <div class="col-md-6 my-1">
        <div class="h-55 p-2 bg-body-tertiary border rounded-top-3 d-flex justify-content-evenly">
        <img class="rounded-3" src="{{ asset('img/sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg')}}" alt="" style="max-height: 6rem">
        <div class="col ms-3 pt-1 align-items-center lh-base">
          <div class="lh-1">
          <p>{{ $data->produk->nama }}</p>
          <p>{{ ($data->produk->berat * $data->kuantitas) }} {{ $data->produk->unit->nama }}</p>
          </div>
          <p class="d-inline text-danger">Rp. {{ number_format($data->produk->harga * $data->kuantitas) }}</p><br>
          <p class="border d-inline">jumlah pesanan : &nbsp;&nbsp;{{ $data->kuantitas }}&nbsp;&nbsp;</p>
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
    

@endsection