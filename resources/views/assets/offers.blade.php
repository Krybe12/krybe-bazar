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
    <a href="">
      <div class="card mb-3 ofr rounded-3 border border-2 shadow">
        <div class="row g-0">
          <div class="col-sm-auto">
            <img src="{{ $offer->images[0]->url }}" alt="{{ $offer->images[0]->alt }}" class="img-fluid rounded-start oimg">
          </div>
          <div class="col">
            <div class="card-body h-100 d-flex flex-column justify-content-between ps-md-5">
              <h5 class="card-title"> {{ $offer->header }} </h5>
              <p class="card-text p-0 pb-2 m-0"> {{ strlen($offer->description) > 160 ? substr($offer->description, strlen($offer->description) - 160) . "..." : $offer->description}} </p>
              <div></div><div></div><div></div>
              <div class="d-flex justify-content-between p-0 m-0">
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

{{-- 
  <div class="bg-white rounded-3 border border-2 shadow mb-2 ofr">
    <div class="row justify-content-center">
      <div class="col-auto">
        <img class="rounded-start oimg" src="{{ $offer->images[0]->url }}" alt="{{ $offer->images[0]->alt }}">
      </div>
      <div class="col d-flex ms-2 ms-md-0">
        <div class="d-flex justify-content-start flex-column py-2 text-wrap">
          <div class="col"> 
            <h5>{{ $offer->header }}</h5>
          </div>
          <div class="col d-none d-md-block"> 
            {{ $offer->description }} 
          </div>
          <div class="col"> 
            {{ $offer->price }}       
          </div>
        </div>
      </div>
    </div>
  </div> --}}