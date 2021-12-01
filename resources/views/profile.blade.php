@extends('layout')
@section('title') {{ $titleText }} @endsection

@section('content')
  <div class="d-flex flex-column align-items-center justify-content-center py-4">
    <div class="col">
      <h1 class="pb-md-4 pb-2"><b> Profile of {{ $user->user_name }} </b></h1>
    </div>

    <div class="col d-flex flex-column flex-md-row border shadow bg-white rounded-3 p-2">
      asd
    </div>
  </div>
@endsection