@extends('layout')
@section('title') {{ $offer->header }} @endsection

@section('content')
  <div class="d-flex flex-column align-items-center justify-content-center py-4">
    <div class="col">
      <h1 class="pb-md-4 pb-2"><b> {{ $offer->header }} </b></h1>
    </div>
    <div class="col d-flex flex-column flex-md-row border shadow bg-white rounded-3">

      <div class="col-auto row flex-md-column m-2 pt-1"> {{-- imgdiv --}}
        <button class="d-flex btn-sm btn-dark justify-content-center mb-2" onclick="javascript:history.back()">
          <i class="bi bi-arrow-left">Back</i>
        </button>

        @foreach ($offer->images as $img)
          <div class="col-auto m-1 px-0">
            <img src="{{ $img->url }}" alt="{{ $img->alt }}" class="img-fluid offerimg rounded-2 shadow border border-1">
          </div>
        @endforeach
      </div>
      <div class="col d-flex justify-content-center justify-content-md-start mx-3">
        <img id="selectedImg" src="{{$offer->images[0]?->url ?? 'https://dummyimage.com/500x500/ffffff/000.png&text=No-image'}}" alt="{{$offer->images[0]?->alt ?? 'no image'}}" style="object-fit: contain; width: 40vw; height: 58vh; min-width: 330px; min-height: 280px">
      </div>

      <div class="col d-flex flex-column m-3">
        <div class="col d-flex align-items-start flex-column ps-3">
          <label><i class="bi bi-cash-stack"></i> Price</label><h2 style="color: orange">{{ $offer->price }}<?php echo $offer->currency->code ?></h2> 
          <label><i class="bi bi-recycle"></i> State</label><h3 >{{ $offer->state->name }} </h3>
          <label><i class="bi bi-calendar2"></i> Created</label><h3 >{{ $offer->created_at }} </h3>
          @if ($offer->created_at != $offer->updated_at)
          <label><i class="bi bi-calendar2-plus"></i> Last update</label><h3 >{{ $offer->updated_at }} </h3>
          @endif          
        </div>
        
        <div class="col-auto align-items-start ps-3 pe-2 pt-3">
          <div class="d-flex">

            @if (Auth::check() && Auth::id() === $offer->user_id || Auth::check() && Auth::user()->admin)

              <button type="button" class="btn btn-danger w-100 mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Delete
              </button>
              <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this offer?
                    </div>
                    <div class="modal-footer justify-content-center">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <a href="/offer/{{ $offer->tag }}/delete" class="btn btn-danger">Delete</a>
                    </div>
                  </div>
                </div>
              </div>

              <a href="/offer/{{ $offer->tag }}/edit" class="btn btn-success w-100 mx-1">Edit</a>
            @endif

          </div>
        </div>

      </div>
    </div>
    <div class="pt-4">
      <nav class="d-flex justify-content-center">
        <div class="nav nav-tabs pb-1" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-description" aria-selected="true">Item description</button>
          <button class="nav-link" id="nav-seller-tab" data-bs-toggle="tab" data-bs-target="#nav-seller" type="button" role="tab" aria-controls="nav-seller" aria-selected="false">Seller information</button>
        </div>
      </nav>
      <div class="tab-content border shadow bg-white rounded-3" id="nav-tabContent" style="min-width: 50vw; width: 92vw; min-width: 330px; max-width: 650px;">

        <div class="tab-pane fade show active m-4" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab" style="min-height: 100px">
          <p> {{ $offer->description }} </p>
        </div>

        <div class="tab-pane fade m-3" id="nav-seller" role="tabpanel" aria-labelledby="nav-profile-tab" style="min-height: 100px;">
          <div class="d-flex row">
            <div class="col">
              <h4>Contact</h4>
            </div>

            <div class="col-auto flex-column d-flex align-items-start">
              <table class="table table-borderless table-responsive">
                <tbody>
                  <tr>
                    <td class="text-nowrap"><i class="bi bi-person-fill"></i> User: </td>
                    <td> <a href="/profile/{{ $offer->user->id . "-" . $offer->user->user_name }}" style="color: blue">{{ $offer->user->user_name . ' (' . $offer->user->name . ')' }}</a></td>
                  </tr>

                  @if ($offer->user->email != "null")
                    <tr>
                      <td class="text-nowrap"><i class="bi bi-at"></i> Email: </td>
                      <td> <a href="mailto:{{ $offer->user->email }}" style="color: blue"> {{ $offer->user->email }} </a></td>
                    </tr>
                  @endif

                  @if ($offer->user->phone_number != "null")
                    <tr>
                      <td class="text-nowrap"><i class="bi bi-phone"></i> Telephone: </td>
                      <td> <a href="tel:{{ $offer->user->phone_number }}" style="color: blue"> {{ $offer->user->phone_number }} </a></td>
                    </tr>
                  @endif
                </tbody>
              </table>
          
            </div>
          </div>
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
        mainImg.alt = e.target.alt;
        e.target.classList.add('selectedimg');
      })
    });
  </script>
@endsection