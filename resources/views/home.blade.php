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
      
      <div id="ofrs" class="col">

        @include('assets.offers')

      </div>
    </div>
  </div>
</div>
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
      await fetch(`${window.location.href.split('.com')[0]}/offers/?page=${page}`)
        .then(response => response.text())
        .then(data => document.getElementById('ofrs').innerHTML = data)
      addEventListeners()
    }
    </script>
@endsection