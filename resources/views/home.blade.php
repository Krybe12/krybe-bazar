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
        <div class="d-flex ms-md-0 p-0 rounded-3 flex-column flex-md-row ct">
          <button type="button" data-id="{{ $category->id }}" class="btn d-flex w-100 align-items-center catbtn">
            <i class="bi bi-{{ $category->icon }}"></i>
            <p class="ps-1 my-1"> {{ $category->name }}</p>
          </button>
        </div>
      @endforeach
      <div class="w-100"></div>
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
        </div>
    </div>

  </div>
  <div class="col">

    <div id="mp" class="flex-column ps-0 ps-md-3 ps-lg-5 ofr pt-2">
      
    </div>

  </div>
</div>

<script>
class Offers{
  constructor(){
    this.perPage = 5;
    this.category = "";
    this.e = document.getElementById("mp")
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
    await fetch(`/offers?page=${page}&category=${this.category}`)
      .then(response => response.text())
      .then(data => this.e.innerHTML = data);
    await this.setPaginationEventListeners();
  }
  setCategoryEventListeners(){
    document.querySelectorAll('.catbtn')
      .forEach(element => {
        element.addEventListener('click', (e) => {
          let selectedBtn = document.querySelector('.activeb')
          let tagetBtn = e.currentTarget;
          let targetId = btn.dataset.id;
          selectedBtn?.classList.remove("activeb");
          if (selectedBtn == tagetBtn){
            targetId = "";
          } else {
             tagetBtn.classList.add("activeb");
          }
          page.setCategory(id);
        })
      })
  }
  setCategory(categoryId){
    this.category = categoryId;
    this.getData(this.page);
  }
}
let page = new Offers();
page.getData(1);
page.setCategoryEventListeners();

</script>
@endsection