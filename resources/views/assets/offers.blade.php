<div class="col">
  <div class="row d-flex align-items-center">
    <div class="col d-flex justify-content-start">
      <h2>{{ $category }}</h2>
    </div>
    <div class="col d-flex justify-content-end">
      {{ $offers->onEachSide(1)->links() }}
    </div>
  </div>
</div>
<div class="col">
  
  @foreach ($offers as $offer)
    <a href="/offer/{{ $offer->tag }}">
      <div class="card mb-3 ofr rounded-3 border border-2 shadow text-center text-sm-start">
        <div class="row g-0">
          <div class="col-sm-auto">
            <img src="{{ $offer->images[0]?->url ?? 'https://dummyimage.com/500x500/ffffff/000.png&text=No-image' }}" alt="{{ $offer->images[0]?->alt ?? 'no image'}}" class="img-fluid rounded-start oimg">
          </div>
          <div class="col">
            <div class="card-body h-100 d-flex flex-column justify-content-between ps-md-5">
              <h5 class="card-title"> {{ $offer->header }} </h5>
              <p class="card-text p-0 pb-2 m-0"> {{ strlen($offer->description) > 150 ? substr($offer->description, strlen($offer->description) - 150) . "..." : $offer->description}} </p>
              <div></div><div></div><div></div>
              <div class="d-flex flex-column flex-sm-row justify-content-between p-0 m-0">
                <p class="card-text p-0 m-0"> Price: {{ $offer->price }}  {{ $offer->currency->name }} </p>
                <p></p>
                <p class="card-text p-0 m-0"><small class="text-muted">Created {{ $offer->created_at }} </small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    @endforeach
    
  </div>