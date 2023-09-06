@extends('layouts.template')

@section('landing')
<div class="container">
        <table class="table border mt-5">
        <tbody>
            @foreach ($keranjang as $data)
            <tr class="col-sm-2">
                <td>trx<span class="text-danger">{{ date('Ymd', strtotime($data->date)) }}</span> - <button class="btn text-info border-0">Buka</button> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection