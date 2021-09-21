@extends('layout')
@section('title') Login @endsection

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center py-5">
    @isset($_GET["msg"])
    <div class="alert alert-warning" role="alert">
      {{ $_GET["msg"] }}
    </div>
    @endisset
      <div class="bg-light rounded-3">
        <form action="" method="POST" class="p-4">
          @csrf
          <div class="mb-3">
            <label  class="form-label">Username</label>
            <input type="text" name="name" class="form-control" placeholder="" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label  class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" required>
          </div>
          <div class="mb-1">
            <input type="submit" class="form-control btn btn-primary" value="Login">
          </div>
        </form>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
          <p class="text-danger px-2"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg> {{ $error }} </p>
        @endforeach
      @endif
      </div>
    </div>
@endsection