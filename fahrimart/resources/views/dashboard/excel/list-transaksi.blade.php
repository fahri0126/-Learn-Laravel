@extends('dashboard.layouts.template')

@section('landing')

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Tanggal</th>
        <th>Harga</th>
        <th>Diskon</th>
    </tr>
    @foreach ($collection as $item)
    <tr>

    </tr>
    @endforeach
</table>

@endsection