@extends('dashboard.layouts.template')

@section('landing')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-3 border-bottom">
    <h1 class="h2">Produk</h1>
</div>

@if (session()->has('berhasil'))
    <div class="alert alert-success alert-dismissible fade show mt-2 col-md-12" role="alert">
        {{ session('berhasil') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="d-flex justify-content-between">
  <a href="/dashboard/produk/create" class="btn btn-primary mb-3">Tambah Produk</a>
            {{ $produk->links() }}
</div>

<div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Produk</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Berat</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($produk as $data )
                <tr class="fs-6">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->kategori->nama ?? 'N/A'}}</td>
                  <td>
                  @if($data->unit->nama ?? '' === null)
                  {{ $data->berat }} {{ $data->unit->nama ?? 'N/A'}}
                  @else
                  N/A
                  @endif
                  </td>
                  <td>Rp. {{ number_format($data->harga, 0, ',', ',') }}</td>
                  <td>
                    <div class="d-flex">
                    <a href="/dashboard/produk/{{ $data->nama }}"><i class="bi bi-eye fs-4 text-info"></i></a>
                    <a href="/dashboard/produk/{{ $data->nama }}/edit" class="mx-3"><i class="bi bi-pencil-square fs-4 text-warning"></i></a>
                    <form action="/dashboard/produk/{{ $data->nama }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="border-0 d-inline" onclick="return confirm('hapus data?')"><i class="bi bi-x-square fs-4 text-danger"></i></button>
                    </form>
                    </div>
                  </td>
                </tr> 
                @endforeach
              </tbody>
            </table>
          </div>

@endsection