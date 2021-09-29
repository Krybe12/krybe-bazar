@extends('layout')
@section('title') Home @endsection

@section('content')
  <h1>ahoj more</h1>
  @auth
  <h2>{{ Auth::user()->admin ? "ano" : "ne"}}</h2>      
  @endauth
@endsection