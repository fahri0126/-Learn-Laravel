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
                        <button class="btn btn-success btn-addon" type="button" onclick="store({{ $item->id }})">
                        <i class="bi-cart"></i> add to cart</button>
                    </form>
                    @endauth
                    <div class="dropdown">
                        <button class="btn btn-addon ms-1 border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @guest
                        Share        
                        @endguest
                        <i class="bi-share fs-6"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <!-- AddToAny BEGIN -->
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <p class="lh-1 fw-medium d-flex justify-content-center">Share </p>
                                        <a class="a2a_button_facebook text-decoration-none d-flex align-items-center text-black" href="http://fahrimart/produk/{{ $item->nama }}" target="_blank">facebook</a>
                                        <a class="a2a_button_twitter text-decoration-none py-1 d-flex align-items-center text-black" href="http://fahrimart/produk/{{ $item->nama }}" target="_blank">twiter</a>
                                        <a class="a2a_button_whatsapp text-decoration-none d-flex align-items-center text-black" href="http://fahrimart/produk/{{ $item->nama }}" target="_blank">whatsapp</a>
                                        <a class="a2a_button_google_gmail text-decoration-none py-1 d-flex align-items-center text-black" href="http://fahrimart/produk/{{ $item->nama }}" target="_blank">gmail</a>
                                        <a class="a2a_button_copy_link text-decoration-none d-flex align-items-center text-black" href="http://fahrimart/produk/{{ $item->nama }}" target="_blank">copy</a>
                                        <a class="a2a_dd text-decoration-none d-flex align-items-center pt-1 text-black" href="https://www.addtoany.com/share" target="_blank">more</i></a>
                                    </div>
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                    <!-- AddToAny END -->
                            {{-- <li><a class="dropdown-item" href="https://wa.me/?text=http://laravel10.test/produk/{{ $item['nama'] }}" target="_blank">wa</a></li> --}}
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

<script>
    function store(prdId){
        $.ajax({
            type: "POST",
            url: "/favorit/store",
            data: {
                _token: "{{ csrf_token() }}",
                produk_id: prdId,
                kuantitas: 1
            },
            success: function(response){
                updateCartBadgeOnChange();
            },
            error: function(error){
                console.log(error);
                alert(error);
            }
        });
    }
</script>

@endsection