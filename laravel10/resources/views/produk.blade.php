@extends('layouts.template')


@section('landing')
{{-- @if ($produk->count()) --}}

<div class="container">
  <div class="pt-3">{{ $produk->links() }}</div>
 <div class="row d-flex justify-content-center">
@foreach ($produk as $data)
<div class="col-md-3 mt-3">
            <div class="card">
              <a href="/produk?pencarian={{ $data->nama }}"><img src="{{ asset('img/sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg')}}" class="card-img-top" alt="#" style="max-height: 12rem; min-height: 12rem;" /></a>
              <div class="card-body">
                <p class="card-text fs-5">
                  <strong>{{ $data->nama }}</strong>
                  <p class="card-text"><a class="text-success" href="/produk?kategori={{ $data->kategori->nama }}">{{ $data->kategori->nama }}</a></p>
                </p>
                <div class="d-flex justify-content-between">
                <p class="card-text">Rp. {{ $data->harga }}</p>
                <a href=""><img class="" src="img/cart2.svg" alt=""></a>
              </div>
              <div class="d-flex justify-content-center">
                <button type="button" name="beli" class="btn btn-outline-success" style="width: 200px">Beli</button>
              </div>
              </div>
            </div>
</div>
@endforeach
</div>
</div>
{{-- @else

<h1 class="text-center">not found</h1>
  
@endif --}}


@include('partials.perenggang')
@endsection
