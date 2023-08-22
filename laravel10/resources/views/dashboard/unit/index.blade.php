@extends('dashboard.layouts.template')

@section('landing')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-3 border-bottom">
    <h1 class="h2">Satuan</h1>
</div>

@if (session()->has('berhasil'))
    <div class="alert alert-success alert-dismissible fade show mt-2 col-md-12 col-lg-6" role="alert">
        {{ session('berhasil') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<a href="/dashboard/unit/create" class="btn btn-primary mb-3">Tambah Satuan</a>


<div class="table-responsive small col-lg-6">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Satuan</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($unit as $data )
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->nama }}</td>
                  <td>
                    <div class="d-flex">
                    <a href="/dashboard/unit/{{ $data->id }}" class="me-3"><i class="bi bi-eye fs-4 text-info"></i></a>
                    <a href="/dashboard/unit/{{ $data->id }}/edit" class="me-3"><i class="bi bi-pencil-square fs-4 text-warning"></i></a>
                    <form action="/dashboard/unit/{{ $data->id }}" method="post">
                      @method('delete')
                      @csrf
                      <button class="border-0" onclick="return confirm('Hapus Data?')"><i class="bi bi-x-square fs-4 text-danger d-inline"></i></button>
                    </form>
                    </div>
                  </td>
                </tr> 
                @endforeach
              </tbody>
            </table>
          </div>

@endsection