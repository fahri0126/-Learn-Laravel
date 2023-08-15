@extends('layouts.template')

@section('landing')

<div class="container">
 <div class="row justify-content-center mt-5">
    <div class="col-md-6">
            <main class="form-registration w-100 m-auto">
                    <h1 class="h3 mb-3 fw-normal">Registration</h1>
                <form action="/register" method="post">
                    @csrf
                    <div class="form-floating">
                    <input type="text" name="name" class="form-control mb-1 @error('name') is-invalid @enderror" id="name" placeholder="name" value="{{ old('name') }}">
                    <label for="name">Name</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="text" name="username" class="form-control mb-1 @error('username') is-invalid @enderror" id="username" placeholder="username" value="{{ old('username') }}">
                    <label for="username">Username</label>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="email" name="email" class="form-control mb-1 @error('email')is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password')is-invalid @enderror" id="password" placeholder="Password">
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Register</button>
                </form>
                <small class="d-block text-center mt-2">Already registered ? <a href="/login">login</a></small>
            </main>
    </div>
  </div>
</div>

@endsection