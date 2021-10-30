@extends('layout')
@section('title') Home @endsection

@section('content')
<div class="d-flex flex-column flex-md-row pt-4 px-0 px-md-2 px-lg-4">
  <div class="col-auto bg-white rounded-3 shadow">
    <div class="d-flex justify-content-md-start justify-content-center ps-1 ps-md-3 pt-2 pb-0 align-items-center">
      <h2>Categories</h2>
    </div>
    <div class="d-flex flex-row flex-md-column p-0 p-md-3 flex-wrap text-center text-md-start justify-content-center">
      
      @foreach ($categories as $category)
        <a  href="/category/{{ $category->name }}">
          <div class="d-flex ms-md-0 p-1 rounded-3 flex-column flex-md-row ct align-items-center">
            <i class="bi bi-{{ $category->icon }}"></i>
            <p class="ps-1 my-1"> {{ $category->name }}</p>
          </div>
        </a>
      @endforeach

    </div>
  </div>
  <div class="col">
    <div class="flex-column ps-0 ps-md-3 ps-lg-5">
      <div class="col">
        <div class="row d-flex align-items-center">
          <div class="col d-flex justify-content-start">
            <h2>Home</h2>
          </div>
          <div class="col d-flex justify-content-end">
            {{ $offers->links() }}
          </div>
        </div>
      </div>
      <div class="col">
        
        @foreach ($offers as $offer)
          <a href="">
            <div class="bg-white rounded-3 border border-2 shadow mb-2" style="max-width: 900px;">
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
                      aaaa aaaa aaaa aaaaaaaaa aaaaaaaaa aaaaaaaaa aaaaaa aaaaaaa aaaaaa aaaa aaaa aaa {{-- 80 --}}
                    </div>
                    <div class="col"> {{-- price --}}
                      9999999999 {{-- 10 --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        @endforeach

      

      </div>
    </div>
  </div>
</div>
<<<<<<< HEAD
  <script>
    async function addEventListeners(){
      let x = [...document.querySelectorAll('.pagination a')];
      x.forEach( x => x.addEventListener("click", function(event){
        event.preventDefault();
        let page = this.href.split('page=')[1];
        fetch_data(page);
      }));
    }
    addEventListeners()
/*     var url_string = window.location.href;
    var url = new URL(url_string);
    var page = url.searchParams.get("page") || 1; */
    //fetch_data(page);

    async function fetch_data(page){
      let url = `${window.location.href.split('.com')[0] + '.com'}/offers/?page=${page}`
      url = url.replace('http', 'https')
      await fetch(url)
        .then(response => response.text())
        .then(data => document.getElementById('ofrs').innerHTML = data)
      addEventListeners()
    }
    </script>
=======
{{--   @auth
  <h2>{{ Auth::user()->admin ? "ano" : "ne"}}</h2>      
  @endauth --}}
>>>>>>> parent of 4d1bd3c (ajax)
@endsection