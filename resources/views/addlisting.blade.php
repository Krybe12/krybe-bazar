@extends('layout')
@section('title') Add Listing @endsection

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center py-4">
  <div>
    <h1 class="pb-md-4 pb-2"><b>Add listing</b></h1>
  </div>
  <div class="border shadow bg-white rounded-3">
    <form action="" method="POST" enctype="multipart/form-data" class="p-4">
      @csrf
      <div class="row justify-content-center">
        <div class="col-auto">
          <div class="mb-3">
            <label  class="form-label"><i class="bi bi-card-heading"></i> Header</label>
            <input type="text" name="header" class="form-control" placeholder="" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label  class="form-label"><i class="bi bi-card-text"></i> Description</label>
            <textarea type="text" name="description" class="form-control" placeholder="" rows="5" cols="40" style="height: 124px;" required></textarea>
          </div>
          <div class="mb-3">
            <label  class="form-label"><i class="bi bi-cash-stack"></i> Price</label>
            <div class="row">
              <div class="col pe-0">
                <input type="number" class="form-control" name="price" min="0"> 
              </div>
              <div class="col-auto ps-1">
                <select name="currency" class="form-select" id="">
                  @foreach ($currencies as $currency)
                    <option value= {{$currency->id}} > {{$currency->name}} </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="col-auto">
    
          <div class="mb-3">
            <label  class="form-label"><i class="bi bi-card-image"></i> Upload main image</label>
            <input type="file" class="form-control" accept="image/png, image/jpeg, image/heic" name="mainimg">
          </div>
          <div class="mb-3">
            <label  class="form-label"><i class="bi bi-image-fill"></i> Upload other images</label>
            <input type="file" class="form-control" accept="image/png, image/jpeg, image/heic" name="otherimg[]" multiple>
          </div>
    
          <div class="mb-3">
            <label  class="form-label"><i class="bi bi-recycle"></i> State</label>
            <select class="form-select" name="state">
              @foreach ($states as $state)
                <option value= {{$state->id}} > {{$state->name}} </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label  class="form-label"><i class="bi bi-list"></i> Category</label>
            <select class="form-select" name="category">
              @foreach ($categories as $category)
                <option value= {{$category->id}} > {{$category->name}} </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      
      
      
      <div class="pt-2">
        <input type="submit" class="form-control btn btn-primary" value="Add listing">
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
</div>
@endsection