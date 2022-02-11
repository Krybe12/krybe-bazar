@extends('layout')
@section('title') Stats @endsection

@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center py-4">
      <div>
        <h1 class="pb-md-5 pb-2"><b>Stats</b></h1>
      </div>
      <div class="row">
        @foreach ($dataArr as $data)

          <div class="col d-flex flex-column align-items-center text-center p-4" style="max-width: 210px">
            <h2> {{ $data["data"] }} </h2>
            <hr class="border border-dark bg-dark mt-0 w-100">
            <h4> {{ $data["name"] }} </h4>
          </div>

        @endforeach
            
      </div>
  
    </div>
@endsection