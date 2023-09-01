@extends('layouts.template')

@section('landing')
<div class="container py-4">
        @include('partials.cart')
</div>
@php
    $totalHarga = 0;
@endphp

@foreach ($keranjang as $item)
@php
    $totalHarga += $item ->produk->harga * $item->kuantitas;
@endphp
@endforeach

<nav class="navbar fixed-bottom navbar-expand-lg bg-body-tertiary shadow-lg">
  <div class="container">
    <p class="">Total harga : <span class="text-danger total-harga">{{ number_format($totalHarga )}}</span></p>
    <form class="check-out-form">
        @csrf
        <input type="hidden" name="status" value="{{ 1 }}">
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="date" value="{{ now() }}">
        @foreach ($keranjang as $kd)
        <input type="hidden" name="produk_id[]" value="{{ $kd->produk_id }}">
        <input type="hidden" name="kuantitas[]" value="{{ $kd->kuantitas }}">
        @endforeach
        @if (count($keranjang) == 0 )
        <button type="button" class="ms-auto btn btn-danger disabled"  onclick="store(this)">Checkout</button>
        @else
        <button id="checkout" type="button" class="ms-auto btn btn-danger" onclick="store(this)">Checkout</button>
        @endif
    </form>
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
                updateCartBadgeOnChange();
                updateHarga()
                
            },
            error: function (error) {
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
            updateHarga()

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


    function updateHargaOnChange() {
    $.ajax({
        type: 'GET',
        url: '/keranjang/totalHarga',
        success: function(response) {
            var totalHarga = $('.total-harga');
            totalHarga.text(response.harga);
            if (response.harga > 0) {
                totalHarga.show();
            } else {
                totalHarga.hide();
            }
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

</script>


@include('partials.perenggang')
@endsection
