<div class="d-flex flex-row justify-content-between ofr">
  <h2>Home</h2>
  {!! $offers->links() !!}
</div>

@foreach ($offers as $offer)
<a href="">
  <div class="bg-white rounded-3 border border-2 shadow mb-2 ofr">
    <div class="row">
      <div class="col-auto">
        <img class="rounded-start" src="{{ $offer->images[0]->url}}" alt="" style="max-width: 200px; max-height: 160px;" height="180">
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