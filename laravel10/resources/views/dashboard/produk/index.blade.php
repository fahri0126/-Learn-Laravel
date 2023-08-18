@extends('dashboard.layouts.template')

@section('landing')
<h1>Produk</h1>
<hr>

<div class="table-responsive small">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Produk</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($produk as $data )
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->kategori->nama }}</td>
                  <td>Rp. {{ $data->harga }}</td>
                  <td><a href="/dashboard/produk/{{ $data->id }}">detail</a></td>
                </tr> 
                @endforeach
       
              </tbody>
            </table>
          </div>

@endsection