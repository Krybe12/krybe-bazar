@extends('layout')
@section('title') Home @endsection

@section('content')
<div class="d-flex flex-column flex-md-row align-items-start pt-4 px-0 px-md-2 px-lg-4">

  <div class="col-auto bg-white rounded-3 shadow">
    <div class="d-flex justify-content-md-start justify-content-center ps-1 ps-md-3 pt-2 pb-0 align-items-center">
      <h2>Categories</h2>
    </div>

    <div class="d-flex flex-row flex-md-column mb-1 p-0 p-md-3 pb-md-0 pt-md-1 flex-wrap text-center text-md-start justify-content-center">
      
      @foreach ($categories as $category)
        <div class="d-flex ms-md-0 p-0 m-1 rounded-3 flex-column flex-md-row ct">
          <button type="button" data-id="{{ $category->id }}" data-name="{{ $category->name }}" class="btn d-flex w-100 align-items-center catbtn">
            <i class="bi bi-{{ $category->icon }}"></i>
            <p class="ps-1 my-1">{{ $category->name }}</p>
          </button>
        </div>
      @endforeach

    </div>

    <div class="d-flex flex-column ps-3 pe-5 pt-0">
      <h2>Price sorting</h2>
      <select id="priceSort" class="form-select m-3 mt-2">
        <option value="default">default</option>
        <option value="asc">ascending</option>
        <option value="desc">descending</option>
      </select>
    </div>

    <div class="d-flex flex-column ps-3 pe-5 pt-0">
      <h2>Wear select</h2>
      <select id="wearSelect" class="form-select m-3 mt-2">
        <option value="default">all</option>
        @foreach ($states as $state)
          <option value="{{$state->id}}">{{$state->name}}</option>
        @endforeach
      </select>
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
    this.wearId = "";
    this.price = "";
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
  let url = `/offers?page=${page || 1}${this.category ? "&category=" + this.category : ""}${this.searchQuery ? "&search=" + this.searchQuery : ""}${this.priceSort ? "&price=" + this.priceSort : ""}${this.wearId ? "&wear=" + this.wearId : ""}`;
  this.setPageUrl(url);
  await fetch(url)
    .then(response => response.text())
    .then(data => this.element.innerHTML = data);
    await this.setPaginationEventListeners();
  }

  setEventListeners(){
    document.querySelectorAll('.catbtn')
      .forEach(element => {
        element.addEventListener('click', (e) => {
          let selectedBtn = document.querySelector('.activeb')
          let targetBtn = e.currentTarget;
          let targetId = targetBtn.children[1].innerText;
          selectedBtn?.classList.remove("activeb");
          if (selectedBtn == targetBtn){
            targetId = "";
          } else {
             targetBtn.classList.add("activeb");
          }
          page.setCategory(targetId);
        })
      });

    priceSelect.addEventListener('change', (e) => {
      this.setPriceSorting(priceSelect.value);
    })
    
    wearSelect.addEventListener('change', (e) => {
      this.setWear(wearSelect.value);
    })
  }

  setPriceSorting(sort){
    this.priceSort = sort;
    if (sort === 'default') this.priceSort = "";
    this.getData();
  }

  setWear(wearId){
    this.wearId = wearId;
    if (wearId === 'default') this.wearId = "";
    this.getData();
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
let priceSelect = document.getElementById('priceSort');
let wearSelect = document.getElementById('wearSelect');
let searchInput = document.getElementById('searchInput');
let searchBtn = document.getElementById('searchBtn');

let urlParams = new URLSearchParams(window.location.search)
let category = urlParams.get('category');
let price = urlParams.get('price');
let wearId = urlParams.get('wear');

if (price){
  priceSelect.value = price;
}

if (wearId){
  wearSelect.value = wearId;
}

document.querySelector(`[data-name='${category}']`)?.classList.add('activeb');
let page = new Offers(category);
page.wearId = wearId;
page.priceSort = price;

page.setSearchQuery(urlParams.get('search'));

page.setEventListeners();
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