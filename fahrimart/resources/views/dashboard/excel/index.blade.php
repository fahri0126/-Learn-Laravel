@extends('dashboard.layouts.template')

@section('landing')

@if (session()->has('invalid'))
    <div class="alert alert-warning alert-dismissible fade show mt-2 col-md-4" role="alert">
        <h5>Warning!!</h5>
        {{ session('invalid') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h5>Pilih rentang waktu</h5>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <form action="/transaksi/report-excel" method="post">
        @csrf
        <div class="d-flex">
            <input type="date" class="form-control" name="start" style="max-height: 2rem;">
            <p class="mx-2 text-danger" style="margin-top:10px;">to</p>
            <input type="date" class="form-control" name="end" style="max-height: 2rem;">
        </div>
        <button type="submit" class="btn btn-success mt-3">Export Excel</button>
    </form>
</div>

{{-- <script>
    function validateDates() {
        var start = $('#startDate').val();
        var end = $('#endDate').val();

        var startDate = new Date(start);
        var endDate = new Date(end);

        if (endDate < startDate) {
            alert("input tanggal invalid");
            $('#endDate').val('');
        }
    }

    function date() {
        var start = $('#startDate').val();
        var end = $('#endDate').val();
        
        var startDate = new Date(start);
        var endDate = new Date(end);

        if (endDate < startDate) {
            alert("input tanggal invalid");
            return;
        }

        $.ajax({
            type: "POST",
            url: "/transaksi/report-excel",
            data: {
                _token: "{{ csrf_token() }}",
                start: start,
                end: end
            },
            success: function (response) {
                alert('success');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    $(document).ready(function () {
        $('#dateForm').submit(function (e) {
            e.preventDefault();
        });
    });
</script> --}}

@endsection
