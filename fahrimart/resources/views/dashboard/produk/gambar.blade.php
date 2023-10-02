@extends('dashboard.layouts.template')

@section('landing')

{{-- @if () --}}
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-3 border-bottom">
    <h1 class="h2">Upload Image</h1>

    
<form action="/dashboard/produk/post-image" method="POST" enctype="multipart/form-data">
    @csrf
        <input type="hidden" value="{{ $prdId }}" name="produk_id">
</div>
<div class="row mb-3">
    <div class="col-sm-8">
        <input class="form-control @error('gambar') is-invalid @enderror" name="gambar" type="file" multiple>
        @error('gambar')
        <div class="invalid-feedback">
            <p class="tex-danger">{{ $message }}</p>
        </div>
        @enderror
    </div>
</div>
<button type="submit" class="btn btn-danger">upload</button>
</form>


@if ($gambar->count() > 0)
<div class="col-lg-3">
<table class="mt-5 table table-bordered">
@foreach ($gambar as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>
        <img src="{{ asset('storage/'. $item->gambar) }}" alt="" style="height: 90px">
    </td>
    <td>
        <form action="/dashboard/produk/delete-image/{{ $prdId }}/{{ $item->id }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mt-4">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>
</div>
@endif

{{-- @else
    
@endif --}}
@endsection