@extends('layout')
@section('title') Home @endsection

@section('content')
  <h1>ahoj more</h1>
  <h2>{{ Auth::user()->admin ? "ano" : "ne"}}</h2>
@endsection