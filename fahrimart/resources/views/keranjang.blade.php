@extends('layouts.template')

@section('landing')
<div class="container">
@if ($keranjang->count() > 0)
<div class="dropdown mt-3" id="use-discount" style="display: none">
    <button class="btn btn dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Use Discount
    </button>
    <ul class="dropdown-menu">
        @include('partials.diskon')
    </ul>
</div>
@endif
</div>
    
<div class="container py-4">
        @include('partials.cart')
</div>

<nav class="navbar fixed-bottom navbar-expand-lg bg-body-tertiary shadow-lg">
  <div class="container">
      <p>Total harga : <span class="text-danger">Rp.
        <span class="total-harga"></span>
        <span class="text-black discount">% off
        {{-- <input type="hidden" id="total_harga"> --}}
      </p>
      <div class="d-flex">
        <button class="d-inline me-2 btn btn-secondary"><a href="/keranjang/hold-item" class="text-white text-decoration-none">Hold item</a></button>
    <form class="hold-form">
        @csrf
        <input id="holdStatus" type="hidden" name="status" value="{{ 2 }}">
        @if (count($keranjang) === 0 )
        <button type="button" class="ms-auto btn btn-secondary disabled me-5" onclick="holdButton()">Hold</button>
        @else
        <button id="holdy" type="button" class="ms-auto btn btn-secondary me-5" onclick="holdButton()">Hold</button>
        @endif
    </form>
    <form class="check-out-form">
        @csrf
        <input type="hidden" name="status" value="{{ 1 }}">
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="date" value="{{ now() }}">
        @foreach ($keranjang as $kd)
        <input type="hidden" name="produk_id[]" value="{{ $kd->produk_id }}">
        <input type="hidden" name="kuantitas[]" value="{{ $kd->kuantitas }}">
        @endforeach
        @if (count($keranjang) === 0)
        <button type="button" class="ms-auto btn btn-danger disabled" onclick="store(this)">Checkout</button>
        @else
        <button id="checkout" type="button" class="ms-auto btn btn-danger" onclick="store(this)">Checkout</button>
        @endif
    </form>
    </div>
  </div>
</nav>

<script>
    function store(button){
        var form = $(button).closest('form');
        var status = form.find("input[name='status']").val();
        var user_id = form.find("input[name='user_id']").val();
        var date = form.find("input[name='date']").val();
        var produk_id = form.find("input[name='produk_id[]']").map(function() {
        return $(this).val(); }).get();
        var kuantitas = form.find("input[name='kuantitas[]']").map(function() {
        return $(this).val();}).get();


        $.ajax({
            type: "POST",
            url: "/keranjang/status",
            data: {
                _token: "{{ csrf_token() }}",
                status: status,
                user_id: user_id,
                date: date,
                produk_id: produk_id,
                kuantitas: kuantitas
            },
            success: function (response) {
                $('#cart-content').html(response.html);
                $('#checkout').prop('disabled', true);
                $('#holdy').prop('disabled', true);
                getPrice();
                updateCartBadgeOnChange();
                updateHarga();
                
            },
            error: function (error) {
                console.log(error).closest('form');
            }
        });
    }

    function holdButton(){
        var hold = $("#holdStatus").val();
        $.ajax({
            type: "POST",
            url: "/keranjang/hold",
            data : {
                _token: "{{ csrf_token() }}",
                holdStatus : hold
            },
            success: function (response) {
                $('#holdy').prop('disabled', true);
                $('#checkout').prop('disabled', true);
                updateHarga();
                getPrice();
                $('#cart-content').html(response.html);
                updateCartBadgeOnChange();
                
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    function decreaseQuantity(button) {
        var productId = $(button).data('product-id');
        var currentQuantity = parseInt($(button).data('quantity'));
        updateCartBadgeOnChange();
        if (currentQuantity > 1) {
            updateQuantity(productId, -1);
        } else{
            updateQuantity(productId, -1);
        }
    }

    function increaseQuantity(button) {
        var productId = $(button).data('product-id');
        updateQuantity(productId, 1);
        updateCartBadgeOnChange();
    }

    function updateQuantity(productId, change) {
    $.ajax({
        type: "POST",
        url: "/keranjang/update-quantity",
        data: {
            _token: "{{ csrf_token() }}",
            product_id: productId,
            change: change
        },
        success: function (response) {
            var new_quantity = response.new_quantity;
            var productPrice =  response.product_price;
            var totalHargaElement = $('.total-harga');
                totalHargaElement.text(response.totalHarga);
            $('#quantity-' + productId).text(response.new_quantity);
            updateHarga();
            deleteDiskon();
            getPrice();

            var decreaseButton = $('button[data-product-id="' + productId + '"][onclick="decreaseQuantity(this)"]');
            if (new_quantity < 2) {
                decreaseButton.prop('disabled', true);
            } else {
                decreaseButton.prop('disabled', false);
            }

             // Update kuantitas di form checkout
            var checkoutForm = $('.check-out-form');
            var kuantitasInputs = checkoutForm.find("input[name='kuantitas[]']");
            var index = kuantitasInputs.index($('input[data-product-id="' + productId + '"]'));
            kuantitasInputs.eq(index).val(new_quantity);

         },
            error: function (error) {
                console.log(error);
         }
     });
    }

    function checkCart(){
        $.ajax({
            type: "GET",
            url: "/keranjang/check-cart",
            success: function(response){
            if(response.isEmpty === 0){
                $('#checkout').prop('disabled', true);
                $('#holdy').prop('disabled', true);
            }
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    function dropProduk(prdId){
        $.ajax({
            type: "POST",
            url: "/keranjang/drop-produk/" + prdId,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response){
                $('#cart-content').html(response.html);
                checkCart();
                updateHarga();
                updateCartBadgeOnChange();
                deleteDiskon();
                getPrice();

            },
            error: function(error){
                console.log(error);
            }
        });
    }
    
    function updateHargaOnChange() {
    $.ajax({
        type: 'GET',
        url: '/keranjang/totalHarga',
        success: function(response) {
            var totalHarga = $('.total-harga');
            var discount = $('.discount');
            totalHarga.text(response.harga);
            discount.text(response.diskon);
            // getPrice();
        },
        error: function(error) {
            console.log(error);
        }
    });
    }

     $(document).ready(function() {
         updateHargaOnChange();
    });

    function updateHarga() {
         updateHargaOnChange();
    }

    function deleteDiskon(){
        $.ajax({
            type: "POST",
            url: "/keranjang/delete-diskon",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response){
            let totalHarga = $('.total-harga');
            let discount = $('.discount');
            totalHarga.text(response.harga);
            discount.text(response.diskon);

            },
            error: function(error){
                console.log(error);
            }
        });
    }
</script>

@include('partials.perenggang')
@endsection
