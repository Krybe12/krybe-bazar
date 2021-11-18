@extends('layout')
@section('title') {{ $offer->header }} @endsection

@section('content')
  <div class="d-flex flex-column align-items-center justify-content-center py-4">
    <div class="col">
      <h1 class="pb-md-4 pb-2"><b> {{ $offer->header }} </b></h1>
    </div>
    <div class="col d-flex flex-column flex-md-row border shadow bg-white rounded-3">

      <div class="col-auto row flex-md-column m-2 pt-1"> {{-- imgdiv --}}
        @foreach ($offer->images as $img)
          <div class="col-auto m-1 px-0">
            <img src="{{ $img->url }}" alt="{{ $img->alt }}" class="img-fluid offerimg rounded-2 shadow border border-1">
          </div>
        @endforeach
      </div>
      <div class="col d-flex justify-content-center justify-content-md-start mx-3">
        <img id="selectedImg" src="{{$offer->images[0]->url}}" alt="" style="object-fit: contain; width: 40vw; height: 58vh; min-width: 330px; min-height: 280px">
      </div>

      <div class="col d-flex flex-column m-3">
        <div class="col d-flex align-items-start flex-column ps-3">
          Price<h2 style="color: orange">{{ $offer->price }}<?php echo $offer->currency->code ?></h2> 
          State<h3 >{{ $offer->state->name }} </h3>
          Created<h3 >{{ $offer->created_at }} </h3>
          @if ($offer->created_at != $offer->updated_at)
            Last update<h3 >{{ $offer->updated_at }} </h3>
          @endif
        </div>
{{--         <div class="col d-flex align-items-start flex-column ps-3 border border-3 rounded-3 bg-secondary">
          User<h2>{{ $offer->user->name }}</h2> 
          Email<h3 >{{ $offer->user->email }} </h3>
          Phone<h3 >{{ $offer->user->phone_number }} </h3>
        </div> --}}
      </div>
    </div>
    <div class="pt-4">
      <nav class="d-flex justify-content-center">
        <div class="nav nav-tabs pb-1" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-description" aria-selected="true">Item description</button>
          <button class="nav-link" id="nav-seller-tab" data-bs-toggle="tab" data-bs-target="#nav-seller" type="button" role="tab" aria-controls="nav-seller" aria-selected="false">Seller information</button>
        </div>
      </nav>
      <div class="tab-content pt-3 border shadow bg-white rounded-3" id="nav-tabContent" style="width: 40vw; min-width: 330px;">

        <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
          description:
            <p> {{ $offer->description }} </p>
        </div>

        <div class="tab-pane fade" id="nav-seller" role="tabpanel" aria-labelledby="nav-profile-tab">
          seller
        </div>

      </div>
    </div>
  </div>
  <script>
    let mainImg = document.getElementById('selectedImg');
    let imgs = document.querySelectorAll('.offerimg');
    document.querySelector('.offerimg').classList.add('selectedimg')
    imgs.forEach(img => {
      img.addEventListener('mouseover', e => {
        document.querySelector('.selectedimg')?.classList.remove('selectedimg');
        mainImg.src = e.target.src;
        e.target.classList.add('selectedimg');
      })
    });
  </script>
@endsection