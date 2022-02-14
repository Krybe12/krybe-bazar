@extends('layout')
@section('title') Home @endsection

@section('content')
<div class="d-flex flex-column flex-md-row align-items-start pt-4 px-0 px-md-2 px-lg-4">

  <div class="col-auto bg-white rounded-3 shadow">
    <div class="d-flex justify-content-md-start justify-content-center ps-1 ps-md-3 pt-2 pb-0 align-items-center">
      <h2>Categories</h2>
    </div>

    <div class="d-flex flex-row flex-md-column mb-2 p-0 p-md-3 flex-wrap text-center text-md-start justify-content-center">
      
      @foreach ($categories as $category)
        <div class="d-flex ms-md-0 p-0 m-1 rounded-3 flex-column flex-md-row ct">
          <button type="button" data-id="{{ $category->id }}" class="btn d-flex w-100 align-items-center catbtn">
            <i class="bi bi-{{ $category->icon }}"></i>
            <p class="ps-1 my-1"> {{ $category->name }}</p>
          </button>
        </div>
      @endforeach
     {{--  <div class="w-100"></div>
      <h3>Price range</h3>
      <div class="w-100"></div>
      <div class="row flex-md-column pb-2">
        <div class="col d-flex justify-content-center align-items-center p-1">
          <label for="minprice">min: </label>
          <input type="number" class="form-control" name="minprice" id="" style="max-width: 120px;">
        </div>
        <div class="col d-flex justify-content-center align-items-center p-1">
          <label for="maxprice">max: </label>
          <input type="number" class="form-control" name="maxprice" id="" style="max-width: 120px;">
        </div>
      </div> --}}
    </div>

  </div>

  <div class="col">
    
    @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show ofr ms-0 ms-md-3 mt-2 mt-md-0 ms-lg-5" role="alert">
      {{ session('status') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>  
    </div>
    @endif

    <div id="mp" class="flex-column ps-0 ps-md-3 ps-lg-5 pt-2" style="max-width: 950px;">
      
    </div>

  </div>
</div>

<script>
class Offers{
  constructor(category = ''){
    this.perPage = 5;
    this.category = category;
    this.element = document.getElementById("mp");
    this.searchQuery = "";
  }

  async setPaginationEventListeners(){
    document.querySelectorAll('.pagination a').forEach(el => {
      el.addEventListener("click", (e) => {
        e.preventDefault();
        this.getData(el.href.split("page=")[1])
      });
    })
  }

  async getData(page){
  let url = `/offers?page=${page || 1}${this.category ? "&category=" + this.category : ""}${this.searchQuery ? "&search=" + this.searchQuery : ""}`;
  this.setPageUrl(url);
  await fetch(url)
    .then(response => response.text())
    .then(data => this.element.innerHTML = data);
    await this.setPaginationEventListeners();
  }

  setCategoryEventListeners(){
    document.querySelectorAll('.catbtn')
      .forEach(element => {
        element.addEventListener('click', (e) => {
          let selectedBtn = document.querySelector('.activeb')
          let targetBtn = e.currentTarget;
          let targetId = targetBtn.dataset.id;
          selectedBtn?.classList.remove("activeb");
          if (selectedBtn == targetBtn){
            targetId = "";
          } else {
             targetBtn.classList.add("activeb");
          }
          page.setCategory(targetId);
        })
      })
  }

  setSearchQuery(query){
    searchInput.value = query;
    this.searchQuery = query;
    this.getData();
  }

  setCategory(categoryId){
    this.category = categoryId;
    this.getData();
  }

  setPageUrl(url){
    window.history.replaceState('', '', url.replace('offers', ''))
  }

}

let searchInput = document.getElementById('searchInput');
let searchBtn = document.getElementById('searchBtn');

let urlParams = new URLSearchParams(window.location.search)
let category = urlParams.get('category');

document.querySelector(`[data-id='${category}']`)?.classList.add('activeb');
let page = new Offers(category);
page.setSearchQuery(urlParams.get('search'));
page.getData(urlParams.get('page'));
page.setCategoryEventListeners();

searchBtn.addEventListener('click', (e) => {
  page.setSearchQuery(searchInput.value);
})

searchInput.addEventListener('click', (e) => {
  setTimeout(() => {
    page.setSearchQuery(searchInput.value);
  }, 1);
})

document.addEventListener('keydown', (e) => {
  if (e.code === "Enter") searchBtn.click();
});

</script>
@endsection