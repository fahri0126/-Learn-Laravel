@extends('layouts.template')

@section('landing')

@php
    
@endphp

@foreach ($produk as $item)

<div class="container">
<section id="main-content" class="mt-3">
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                <div class="user-photo mb-3">
                    <img class="img-fluid" src="{{ asset('img/user-profile.jpg') }}" alt="" />
                </div>
                    <div class="">
                    <h3>{{{ $item->nama }}}</h3>
                    <p>RP. {{ number_format($item->harga) }}</p>
                    <p>
                        <div class="rating-star">
                        <span>4.8</span>
                        <i class="bi-star-fill text-warning"></i>
                        <i class="bi-star-fill text-warning"></i>
                        <i class="bi-star-fill text-warning"></i>
                        <i class="bi-star-fill text-warning"></i>
                        <i class="bi-star"></i>
                        </div>
                    </p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="tab-pane active mt-1">
                        <h4>Basic information</h4>
                        <div class="">
                            <span class="contact-title">Kategori:</span>
                            <span class="text-success">{{ $item->kategori->nama }}</span>
                        </div>
                        <div class="">
                            <span class="contact-title">Berat:</span>
                            <span class=""><span class="text-danger">{{ $item->berat }}</span> {{ $item->unit->nama }}</span>
                        </div>
                    </div>

                <ul class="nav nav-tabs my-3"></ul>

                <div class="d-flex mb-2">
                    @auth    
                    <form>
                        <button class="btn btn-success btn-addon" type="button">
                        <i class="bi-cart"></i> add to cart</button>
                    </form>
                    @endauth
                    <div class="dropdown">
                        <button class="btn btn-addon ms-1 border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-share fs-6"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="https://wa.me/?text=http://laravel10.test/produk/{{ $item['nama'] }}" target="_blank">wa</a></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
</div>

@endforeach

@endsection