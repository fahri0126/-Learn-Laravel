@extends('layouts.template')


@section('landing')
{{-- @if ($produk->count()) --}}

<div class="container">
  <div class="pt-3">{{ $produk->links() }}</div>
 <div class="row justify-content-center">

@if (count($produk))

 @foreach ($produk as $data)
<div class="col-md-3 mt-3">
            <div class="card">
              <a href="/produk?pencarian={{ $data->nama }}"><img src="{{ asset('img/sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg')}}" class="card-img-top" alt="#" style="max-height: 12rem; min-height: 12rem;" /></a>
              <div class="card-body">
                <p class="card-text fs-5">
                  <strong>{{ $data->nama }}</strong>
                  <p class="card-text">
                    <a class="text-success"  @if ($data->kategori->nama ?? 'null' === null) href="/produk?kategori={{ $data->kategori->nama ?? 'N/A'}}" @endif>
                      {{ $data->kategori->nama ?? 'N/A'}}</a>
                  </p>
                </p>
                <p class="card-text">berat : {{ $data->berat }} {{ $data->unit->nama ?? 'N/A' }}</p>
                <p class="card-text">Rp. {{ number_format($data->harga, 0, ',', ',') }}</p>

              @auth
              <div class="d-flex justify-content-center">
                <a class="btn btn-outline-success" style="width: 200px">Add to cart <i class="bi bi-cart-plus"></i></a>
              </div>
              @endauth

              </div>
            </div>
    </div>
@endforeach

@else

<div class="container d-flex align-items-end justify-content-center" style="height: 40vh">
  <h5 class="text-secondary">not found | 404</h5>
</div>


@endif
</div>
</div>
{{-- @else

<h1 class="text-center">not found</h1>
  
@endif --}}


@include('partials.perenggang')
@endsection
