@extends('layouts.template')

@section('landing')

<style>
.slick-prev, .slick-next {
    z-index: 999;
    top: 23px;
}

.slick-next {
    right: 1px;
}

.slick-prev {
    left: 1px;
}

.thumbnail {
    cursor: pointer; 
}
</style>

@foreach ($produk as $item)
<div class="container">
<section id="main-content" class="mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="user-photo mb-1 border">
                                <div class="d-flex justify-content-center slider">
                                    <div class="slide">
                                        @if ($item->gambar->count())
                                            <img id="image" src="{{ asset('storage/' . $item->gambar[0]->gambar) }}" alt="Image" style="height: 17rem; width: 22rem">
                                        @else
                                            <img id="image" src="{{ asset('img/fahrimart(6).png') }}" alt="Image" style="height: 17rem; width: 22rem">
                                        @endif
                                    </div>
                                </div>
                            </div>
                    <div class="for-slider">
                        <div class="image-list d-flex justify-content-center">
                            @foreach($item->gambar as $key => $data)
                            <img class="border thumbnail" src="{{ asset('storage/' . $data->gambar) }}" alt="Thumbnail" data-image-id="{{ $data->gambar }}" style="height: 48px; width: 100px">
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-5">
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
                        <div>
                            <span class="contact-title">Kategori:</span>
                            <span class="text-success">{{ $item->kategori->nama }}</span>
                        </div>
                        <div>
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

<script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
<script>
    $(document).ready(function () {
        $('.image-list').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<button class="slick-prev">Previous</button>',
            nextArrow: '<button class="slick-next">Next</button>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2
                    }
                }
            ]
        });

        $('.thumbnail').click(function () {
            var imageId = $(this).data('image-id');
            var imageUrl = "{{ asset('storage/') }}" + "/" + imageId;
            $('#image').attr('src', imageUrl);
        });
    });

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