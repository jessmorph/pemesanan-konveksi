@extends('layouts.main')

@section('container')
<div class="container mt-5">
  <div class="d-flex justify-content-center align-items-center border bgBox">
    <div class="m-5 text-center">
      <img src="{{ url('static/logo.jpeg') }}" alt="gambar" style="width: 50%;">
      <h1>Login Form</h1>
    </div>
  </div>

  @if(session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('loginError') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <form action="/login" method="post">
    @csrf
    <div class="d-flex justify-content-center align-items-center border mt-5 bgBox">
      <div class="m-5 ">
        <div class="row">
          <div class="col-6">
            <label for="username">Username</label>
          </div>
          <div class="col-6">
            <input type="text" name="username" placeholder="enter username" />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-6">
            <label for="password">Password</label>
          </div>
          <div class="col-6">
            <input type="password" name="password" placeholder="enter password" />
          </div>
        </div>
        <div class="row mt-5">
          <input class="btnLogin" type="submit" value="Login" />
        </div>
      </div>
    </div>
  </form>
</div>
@endsection