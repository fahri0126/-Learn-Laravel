@extends('layouts/template')

@section('landing')
<div class="perenggang"></div>

  <!-- biodata -->
  <div id="biodata"></div>

  <section class="container list-group shadow-sm mt-5">
    <div class="row text-center pb-4 pt-3 list-group-item">
      <h2 class="fs-2 fw-light">Status Pesanan</h2>
    </div>
    @foreach ($pesan as $data )

    <div class="row pt-3 list-group-item d-flex">
      <div class="col-md-4"><strong>Nama Pelanggan</strong></div>
      <div class="col-md-4">: {{ $data->pelanggan }}</div>
    </div>
    <div class="row pt-3 list-group-item d-flex">
      <div class="col-md-4"><strong>Status Pesanan</strong></div>
      <div class="col-md-4">: {{ $data->status }}</div>
    </div>
    <div class="row pt-3 list-group-item d-flex justify-content-center">
      <div>&nbsp;</div>
    </div>
    @endforeach
  </section>
@endsection

{{-- <table border="1">
    <tr>
    <th>Pelanggan</th>
    <th>Staus Pengiriman</th>
    </tr>
    @foreach ( $pesan as $data)
    <tr>
        <td>{{ $data->pelanggan }}</td>
        <td>{{ $data->status }}</td>
    </tr>
    @endforeach
</table> --}}