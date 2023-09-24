@extends('dashboard.layouts.template')

@section('landing')


  <div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('img/sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg') }}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg') }}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg') }}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg') }}" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


    <table class="table table-striped table-sm">
    <thead>
    <tr>
        <th scope="col">{{ $produk->nama }}</th>
    </tr>
    <tr>
         <th scope="col">{{ $produk->kategori->nama }}</th>
    </tr>
    <tr>
        <th scope="col">{{ $produk->berat }} {{ $produk->unit->nama }}</th>
    </tr>
    <tr>
        <th scope="col">Rp. {{ $produk->harga }}</th>
    </tr>
    </thead>
    </table>
    </div>
@endsection