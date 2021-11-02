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
          <div class="d-flex ms-md-0 p-1 rounded-3 flex-column flex-md-row ct">
            <button type="button" class="btn d-flex w-100 align-items-center">
              <i class="bi bi-{{ $category->icon }}"></i>
              <p class="ps-1 my-1"> {{ $category->name }}</p>
            </button>

          </div>
      @endforeach

    </div>
  </div>
  <div class="col">

    <div id="mp" class="flex-column ps-0 ps-md-3 ps-lg-5 ofr pt-3">
      
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
    await fetch(`/offers?page=${page}`)
      .then(response => response.text())
      .then(data => this.e.innerHTML = data);
    await this.setPaginationEventListeners();
  }
}
let page = new Offers()
page.getData(1)

</script>
@endsection