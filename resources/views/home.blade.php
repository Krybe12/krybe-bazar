@extends('layout')
@section('title') Home @endsection

@section('content')
<div class="row">
  <div class="col-3 bg-warning">
    @foreach ($categories as $category)
      <i class="bi bi-activity"></i>  
      <a class="h5 text-dark" href="">{{$category->name}}</a>
    @endforeach
  </div>
  <div class="col bg-success">
    main paga
  </div>
  <div class="col bg-info">
    idk ?
  </div>
</div>
  @auth
  <h2>{{ Auth::user()->admin ? "ano" : "ne"}}</h2>      
  @endauth
@endsection