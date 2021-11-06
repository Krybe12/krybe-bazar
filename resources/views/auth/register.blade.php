@extends('layout')
@section('title') Register @endsection

@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center py-4">
      <div>
        <h1 class="pb-md-5 pb-2"><b>Register</b></h1>
      </div>
      <div class="border shadow bg-white rounded-3">
        <form action="" method="POST" class="p-4 pb-2">
          @csrf
          <div class="mb-3">
            <label  class="form-label">Username</label>
            <input type="text" name="user_name" class="form-control" placeholder="John Doe" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label  class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="123456" required>
          </div>
          <div class="mb-3">
            <label  class="form-label">Repeat Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="123456" required>
          </div>
          <div class="mb-1">
            <input type="submit" class="form-control btn btn-primary" value="Register">
          </div>
          <div class="mb-1 text-center">
            <p>Already have an account ? <a class="text-info" href="/register">log in!</a></p>
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