@extends('layout')
@section('title') Register @endsection

@section('content')
  <div class="container-fluid h-100 bg-secondary">
    <div class="d-flex justify-content-center py-5">
      <div class="bg-light rounded-3">
        <form action="" method="POST" class="p-4">
          @csrf
          <div class="mb-3">
            <label  class="form-label">Username</label>
            <input type="text" name="name" class="form-control" placeholder="John doe">
          </div>
          <div class="mb-3">
            <label  class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="">
          </div>
          <div class="mb-3">
            <label  class="form-label">Repeat Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="">
          </div>
          <div class="mb-3">
            <input type="submit" class="form-control" placeholder="">
          </div>
        </form>
      </div>
      @if ($errors->any())
      @foreach ($errors->all() as $error)
          {{$error}}
      @endforeach
    @endif
    </div>
  </div>
@endsection