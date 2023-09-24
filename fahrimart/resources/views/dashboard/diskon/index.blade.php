@extends('dashboard.layouts.template')

@section('landing')
@if (session()->has('success'))
<div class="d-flex ms-auto">
  <div class="alert alert-success alert-dismissible fade show mt-2 col-md-6" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>
@endif

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h5>Atur Diskon</h5>
</div>

    <form action="/dashboard/add-discount" method="POST">
        @csrf
        <div class="d-flex col-md-8">
            <div class="input-group">
                <div class="input-group-append"><span class="input-group-text">RP.</span></div>
                <input type="number" name="harga" class="form-control" autocomplete="off" required>
            </div>
            <div class="input-group">
                <input type="number" name="diskon" class="form-control ms-3 rounded-0" autocomplete="off" required>
                <div class="input-group-prepend"><span class="input-group-text">%</span></div>
            </div>
        </div>
        <div class="d-flex">
            <button class="rounded-0 btn btn-danger mt-3">save<i class="bi bi-check"></i></button>
        </div>
    </form>

    <div class="table-responsive col-lg-8">
            <table class="table table-striped table-sm mt-5">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Price</th>
                  <th scope="col">Discount</th>
                 
                </tr>
              </thead>
              <tbody>
                @foreach ($diskon as $data )
                <tr class="fs-6">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ number_format($data->price) }}</td>
                  <td>{{ intval($data->discount * 100) }}%</td>
                </tr>
                @endforeach
              </tbody>
            </table>
    </div>

@endsection