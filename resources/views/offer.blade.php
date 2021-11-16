@extends('layout')
@section('title') {{ $offer->header }} @endsection

@section('content')
  <div class="d-flex flex-column align-items-center justify-content-center py-4">
    <div class="col">
      <h1 class="pb-md-4 pb-2"><b> {{ $offer->header }} </b></h1>
    </div>
    <div class="col d-flex flex-column flex-md-row border shadow bg-white rounded-3">

      <div class="col-auto row flex-md-column m-0 pt-1"> {{-- imgdiv --}}
        @foreach ($offer->images as $img)
          <div class="col-auto m-1">
            <img src="{{ $img->url }}" alt="{{ $img->alt }}" class="img-fluid offerimg rounded-2 border border-2 shadow">
          </div>
        @endforeach
      </div>
      <div class="col d-flex justify-content-center justify-content-md-start mx-3">
        <img id="selectedImg" src="{{$offer->images[0]->url}}" alt="" style="object-fit: contain; width: 40vw; height: 60vh; min-width: 330px; min-height: 280px">
      </div>

      <div class="col d-flex flex-column m-3">
        <div class="col d-flex align-items-start flex-column ps-3">
          Price<h2 style="color: orange">{{ $offer->price }}<?php echo $offer->currency->code ?></h2> 
          State<h3 >{{ $offer->state->name }} </h3>
          Created<h3 >{{ $offer->created_at }} </h3>
        </div>
{{--         <div class="col d-flex align-items-start flex-column ps-3 border border-3 rounded-3 bg-secondary">
          User<h2>{{ $offer->user->name }}</h2> 
          Email<h3 >{{ $offer->user->email }} </h3>
          Phone<h3 >{{ $offer->user->phone_number }} </h3>
        </div> --}}
      </div>
    </div>
    <div class="pt-3">
      
    </div>
  </div>
  <script>
    let mainImg = document.getElementById('selectedImg');
    let imgs = document.querySelectorAll('.offerimg');
    imgs.forEach(img => {
      img.addEventListener('mouseover', e => {
        mainImg.src = e.target.src;
      })
    });
  </script>
@endsection