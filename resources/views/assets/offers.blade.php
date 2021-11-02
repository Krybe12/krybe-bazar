<div class="col">
  <div class="row d-flex align-items-center">
    <div class="col d-flex justify-content-start">
      <h2>{{ $category }}</h2>
    </div>
    <div class="col d-flex justify-content-end">
      {{ $offers->links() }}
    </div>
  </div>
</div>
<div class="col">
  
  @foreach ($offers as $offer)
    <a href="">
      <div class="bg-white rounded-3 border border-2 shadow mb-2 ofr">
        <div class="row">
          <div class="col-auto">
            <img class="rounded-start oimg" src="{{ $offer->images[0]->url }}" alt="{{ $offer->images[0]->alt }}">
          </div>
          <div class="col d-flex">
            <div class="d-flex justify-content-start flex-column py-2 text-wrap">
              <div class="col"> {{-- header --}}
                <h5>{{ $offer->header }}</h5> {{-- 40 --}}
              </div>
              <div class="col d-none d-md-block"> {{-- description --}}
                {{ $offer->description }} {{-- 80 --}}
              </div>
              <div class="col"> {{-- price --}}
                {{ $offer->price }} {{-- 10 --}}      
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
  @endforeach

</div>