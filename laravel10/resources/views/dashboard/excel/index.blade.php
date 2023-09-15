@extends('dashboard.layouts.template')

@section('landing')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h5>Pilih rentang waktu</h5>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
<form action="/transaksi/report-excel" method="post">
    @csrf
    <div class="d-flex">
        <input type="date" class="form-control"  name="start" id="" style="max-height: 2rem;">
        <p class="mx-2 text-danger" style="margin-top:10px;">to</p>
        <input type="date" class="form-control"  name="end" id="" style="max-height: 2rem;">
    </div>
    <button type="submit" class="btn btn-success">Export Excel</button>
</form>
</div>

@endsection