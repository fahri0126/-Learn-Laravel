@extends('layouts.template')

@section('landing')


<div class="container">
 <div class="row justify-content-center">
    <div class="col-md-6">
      @if (session()->has('berhasil'))
      <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
        {{ session('berhasil') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>  
      @endif
            <main class="form-signin w-100 m-auto mt-5">
                    <h1 class="h3 mb-3 fw-normal">Login</h1>
                <form action="/login" method="post">
                  @csrf
                    <div class="form-floating">
                    <input type="email" class="form-control mb-1" id="email" placeholder="name@example.com" autofocus required>
                    <label for="email">Email address</label>
                    </div>
                    <div class="form-floating">
                    <input type="password" class="form-control" id="password" placeholder="Password">
                    <label for="password">Password</label>
                    </div>
                    <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Login</button>
                </form>
                <small class="d-block text-center mt-2">Not registered ? <a href="/register">register now</a></small>
            </main>
    </div>
  </div>
</div>

@endsection