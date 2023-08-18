@extends('dashboard.layouts.template')


@section('landing')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Welcome to Dashboard <span class="text-success">{{ auth()->user()->name }}</span></h1>
@endsection