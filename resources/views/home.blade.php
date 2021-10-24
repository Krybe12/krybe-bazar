@extends('layout')
@section('title') Home @endsection

@section('content')
<div class="d-flex flex-column flex-md-row pt-4 px-0 px-md-2 px-lg-4">
  <div class="col-auto bg-white rounded-3 shadow">
    <div class="d-flex justify-content-md-start justify-content-center ps-0 ps-md-2 align-items-center">
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
      <div class="col d-flex justify-content-start align-items-center">
        <h2>Home</h2>
      </div>
      <div class="col">
        


        <div class="bg-white rounded-3 border border-2 shadow" style="max-width: 900px;">
          <div class="row">
            <div class="col-auto">
              <img class="rounded-start" src="https://dummyimage.com/600x600/000/fff" alt="" style="max-width: 200px; max-height: 160px;" height="180">
            </div>
            <div class="col d-flex">
              <div class="d-flex justify-content-start flex-column py-2 text-wrap">
                <div class="col text-wrap"> {{-- header --}}
                  aaaaaaa aaaaaaa aaaaaa aaaaaaa aaaaa aaa {{-- 40 --}}
                </div>
                <div class="col d-none d-md-block text-wrap"> {{-- description --}}
                  aaaa aaaa aaaa aaaaaaaaa aaaaaaaaa aaaaaaaaa aaaaaa aaaaaaa aaaaaa aaaa aaaa aaa {{-- 80 --}}
                </div>
                <div class="col text-wrap"> {{-- price --}}
                  9999999999 {{-- 10 --}}
                </div>
              </div>
            </div>
          </div>
        </div>
       



      </div>
    </div>
  </div>
</div>
{{--   @auth
  <h2>{{ Auth::user()->admin ? "ano" : "ne"}}</h2>      
  @endauth --}}
@endsection