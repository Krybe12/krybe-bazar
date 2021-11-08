@extends('layout')
@section('title') {{ $offer->header }} @endsection

@section('content')
<button type="button" value="Go back!" onclick="history.back()">go back</button>
@endsection