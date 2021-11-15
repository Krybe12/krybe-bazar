@extends('layout')
@section('title') {{ $offer->header }} @endsection

@section('content')
  <div class="d-flex flex-column align-items-center justify-content-center py-4">
    <div class="col">
      <h1 class="pb-md-5 pb-2"><b> {{ $offer->header }} </b></h1>
    </div>
    <div class="col d-flex flex-column flex-md-row border shadow bg-white rounded-3">

      <div class="col-auto flex-column"> {{-- imgdiv --}}
        @foreach ($offer->images as $img)
          <div class="col m-1">
            <img src="{{ $img->url }}" alt="{{ $img->alt }}" class="img-fluid offerimg">
          </div>
        @endforeach
      </div>
      <div class="col">
        <img id="selectedImg" src="{{$offer->images[1]->url}}" alt="" style="object-fit: contain; width: 450px; height: 430px">
      </div>

      <div class="col">
        
      </div>

    </div>
  </div>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <p class="text-danger px-2 text-center">
      <i class="bi bi-exclamation-triangle-fill"></i>
      {{ $error }} 
    </p>
  @endforeach
@endif
@endsection