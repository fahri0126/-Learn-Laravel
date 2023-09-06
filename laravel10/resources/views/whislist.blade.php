@extends('layouts.template')

@section('landing')
@include('partials.perenggang')
<div class="container">
    @php
        $halaman = 'Whislist';
    @endphp
    {{-- <div class="pt-3">{{ $produk->links() }}</div> --}}
    <div class="row justify-content-center">
        {{-- @if (count($produk)) --}}
            {{-- @foreach ($produk as $data) --}}
                <div class="col-md-3 mt-3">
                    <div class="card">
                        <img src="{{ asset('img/sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg') }}" class="card-img-top"
                            alt="#" style="max-height: 12rem; min-height: 12rem;" />
                        <div class="card-body">
                            <p class="card-text fs-5">
                                <strong>test</strong>
                                <p class="card-text">
                                    {{-- @if ($data->kategori) --}}
                                        <a class="text-success" href="/produk?kategori="></a>
                                    {{-- @else --}}
                                        {{-- N/A --}}
                                    {{-- @endif --}}
                                </p>
                            </p>
                            <p class="card-text">berat : </p>
                            <p class="card-text">Rp. {{ number_format(0000000000000000) }}</p>
                            @auth
                            <div class="d-flex">
                                <form class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="kuantitas" value="1">
                                    <input type="hidden" name="produk_id" value="">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="date" value="">
                                    <input type="hidden" name="status" value="0">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-outline-success" type="button" onclick="store(this)"style="width: 200px">
                                            Add to cart <i class="bi bi-cart-plus"></i>
                                        </button> 
                                    </div>
                                </form>
                                <form class="whislist">
                                <button class="btn border-0">
                                    <i class="bi-bookmark-dash text-success fs-5"></i>
                                </button>
                                </form>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}
        {{-- @else --}}
            {{-- <div class="container d-flex align-items-end justify-content-center" style="height: 40vh">
                <h5 class="text-secondary">not found | 404</h5>
            </div> --}}
        {{-- @endif --}}
    </div>
</div>