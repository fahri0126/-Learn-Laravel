@extends('layouts.template')

@section('landing')
<div class="container">
      @include('partials.trx')
</div>

<script>
    function tombolBuka(keranjangId){
        $.ajax({
            type: "POST",
            url: "/keranjang/unHold/" + keranjangId,
            data: {
                _token: "{{ csrf_token() }}"
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