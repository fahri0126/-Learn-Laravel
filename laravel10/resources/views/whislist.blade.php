@extends('layouts.template')

@section('landing')
<div class="container">
    @include('partials.favorit')
</div>

<script>
    function hapusFaforit(produkID){
        $.ajax({
            type: "POST",
            url: "/favorit-delete/" + produkID,
            data: {
                _token : "{{ csrf_token() }}",
            },
            success: function(response){
                $('#favorit-content').html(response.html)

            },
            error: function(error){

            }

        });
    }

</script>

@endsection
