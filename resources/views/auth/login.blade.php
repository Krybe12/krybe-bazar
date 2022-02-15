@extends('layout')
@section('title') Login @endsection

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center py-4">
    <div>
      <h1 class="pb-md-5 pb-2"><b>Login</b></h1>
    </div>
    @if(session('msg'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      {{ session('msg') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

      <div class="border shadow bg-white rounded-3">
        <form action="" method="POST" class="p-4 pb-2">
          @csrf
          <div class="mb-3">
            <label  class="form-label">Username</label>
            <input type="text" name="user_name" class="form-control" placeholder="" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label  class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" required>
          </div>
          <div class="mb-1">
            <input type="submit" class="form-control btn btn-primary" value="Login">
          </div>
          <div class="mb-1 text-center">
            <p>Don't have an account yet? <a class="text-info" href="/register">Register now!</a></p>
          </div>
        </form>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
          <p class="text-danger px-2 text-center">
            <i class="bi bi-exclamation-triangle-fill"></i>
            {{ $error }} 
          </p>
        @endforeach
      @endif
      </div>
    </div>
@endsection