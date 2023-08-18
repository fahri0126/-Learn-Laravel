@extends('dashboard.layouts.template')

@section('landing')
<h1>Berat</h1>
<hr>

<div class="table-responsive small">
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
                    <a href="/dashboard/produk/{{ $data->id }}" class="me-3"><i class="bi bi-eye fs-4 text-info"></i></a>
                    <a href="/dashboard/produk/{{ $data->id }}" class="me-3"><i class="bi bi-pencil-square fs-4 text-warning"></i></a>
                    <a href="/dashboard/produk/{{ $data->id }}" class="me-3"><i class="bi bi-x-square fs-4 text-danger"></i></a>
                  </td>
                </tr> 
                @endforeach
              </tbody>
            </table>
          </div>

@endsection