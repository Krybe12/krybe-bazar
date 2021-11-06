@extends('layout')
@section('title') Add info @endsection

@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center py-4">
      <div>
        <h1 class="pb-md-5 pb-2"><b>Add information</b></h1>
      </div>
      @if(session('msg'))
      <div class="alert alert-warning" role="alert">
        {{ session('msg') }}
      </div>
      @endif
      <div class="border shadow bg-white rounded-3">
        <form action="" method="POST" class="p-4 pb-2">
          @csrf
          <div class="mb-3">
            <label  class="form-label">Name*</label>
            <input type="text" name="_name" class="form-control" placeholder="John Doe" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label  class="form-label">Email*</label>
            <input type="email" name="_email" class="form-control" placeholder="john@gmail.com" required>
          </div>

          <div class="mb-3">
            <label  class="form-label">Phone number</label>
            <div class="row">
              <div class="col-auto pe-0">
                <input type="text" name="_telprefix" class="form-control" placeholder="+420" maxlength="10" style="max-width: 75px;">
              </div>
              <div class="col ps-1">
                <input type="tel" name="_tel" class="form-control" placeholder="123456789" style="max-width: 140px;"> 
              </div>
            </div>
          </div>

          <div class="mb-3">
            <input type="submit" class="form-control btn btn-primary" value="Save information">
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