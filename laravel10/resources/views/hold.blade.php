@extends('layouts.template')

@section('landing')
<div class="container">
      @include('partials.trx')
</div>

<script>
    function tombolBuka(){
        var kode_transaksi = $('#kodeTrx').val();
        $.ajax({
            type: "POST",
            url: "/keranjang/unhold",
            data: {
                _token: "{{ csrf_token() }}",
                kode_transaksi: kode_transaksi
            },
            success: function(response){
                $('#trx').html(response.html);
                updateCartBadgeOnChange();
            },
            error: function (error){

            }
        });
    }
</script>
@endsection