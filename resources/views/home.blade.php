@extends('layout')
@section('title') Home @endsection

@section('content')
<div class="d-flex flex-column flex-md-row">
  <div class="col">
    <div class="d-flex justify-content-md-start justify-content-center ps-0 ps-md-4  align-items-center pt-4">
      <h2>Categories</h2>
    </div>
    <div class="d-flex flex-row flex-md-column p-0 p-md-3 flex-wrap text-center text-md-start justify-content-center">
      @foreach ($categories as $category)
      <a  href="/category/{{ $category->name }}">
        <div class="d-flex ms-md-3 p-1 rounded-3 flex-column flex-md-row ct align-items-center">
          <i class="bi bi-{{ $category->icon }}"></i>
          <p class="ps-1 my-1"> {{ $category->name }}</p>
        </div>
        </a>
      @endforeach
    </div>
  </div>
  <div class="col-9">
    content
  </div>
</div>
{{--   @auth
  <h2>{{ Auth::user()->admin ? "ano" : "ne"}}</h2>      
  @endauth --}}
@endsection