@extends('layout')
@section('title') Edit Listing @endsection

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center py-4">
  <div>
    <h1 class="pb-md-4 pb-2"><b>Edit listing</b></h1>
  </div>
  <div class="border shadow bg-white rounded-3">
    <form action="" id="al" method="POST" enctype="multipart/form-data" class="p-4">
      @csrf
      <div class="row justify-content-center">
        <div class="col-auto">
          <div class="mb-3">
            <label  class="form-label"><i class="bi bi-card-heading"></i> Header</label>
            <input type="text" name="header" class="form-control" placeholder="" minlength="4" maxlength="40" autocomplete="off" value="{{ $offer->header }}" required>
          </div>
          <div class="mb-3">
            <label  class="form-label"><i class="bi bi-card-text"></i> Description</label>
            <textarea type="text" name="description" class="form-control" placeholder="" minlength="3" maxlength="500" rows="5" cols="40" style="height: 124px;" required>{{ $offer->description }}</textarea>
          </div>
          <div class="mb-3">
            <label  class="form-label"><i class="bi bi-cash-stack"></i> Price</label>
            <div class="row">
              <div class="col pe-0">
                <input type="number" class="form-control" name="price" min="1" max="9999999" value="{{ $offer->price }}"> 
              </div>
              <div class="col-auto ps-1">
                <select name="currency" class="form-select" id="">
                  @foreach ($currencies as $currency)
                    <option value="{{$currency->id}}" {{ $offer->currency->id === $currency->id ? 'selected' : "" }}> {{ $currency->name}} </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="pt-2">
        <input type="submit" id="sbtn" class="form-control btn btn-success" value="Save">
      </div>
    </form>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
      <p class="text-danger px-2 text-center">
        <i class="bi bi-exclamation-triangle-fill"></i>
        {{ $error }} 
      </p>
    @endforeach
  @endif
  </div>
  <script>
    document.getElementById('al').addEventListener('submit', () => addLoadingState());
    
    function addLoadingState(){
      let x = document.getElementById('sbtn')
      x.value = "Loading..."
      x.classList.remove("btn-primary")
      x.classList.add("btn-warning")
    }

  </script>
</div>
@endsection