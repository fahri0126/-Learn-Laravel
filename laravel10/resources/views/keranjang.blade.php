@extends('layouts.template')

@section('landing')


  <div class="container py-4">
    <div class="row">

        <?php $i = 10; ?>
      @foreach ( $produk as $data)
      <div class="col-md-6 my-1">
        <div class="h-55 p-2 bg-body-tertiary border rounded-top-3 d-flex justify-content-evenly">
        <img class="rounded-3" src="{{ asset('img/sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg')}}" alt="" style="max-height: 6rem">
        <div class="col ms-3 pt-1 align-items-center lh-base">
          <div class="lh-1">
          <p>{{ $data->produk->nama }}</p>
          <p>{{ $data->produk->berat }} {{ $data->produk->unit->nama }}</p>
          </div>
          <p class="d-inline text-danger">Rp. {{ number_format($data->produk->harga) }}</p>
        </div>
      </div>
      <p class="border d-inline">&nbsp;&nbsp;{{ $data->kuantitas }}&nbsp;&nbsp;</p>
      </div>
      @endforeach 

    </div>
  </div>
    

@endsection