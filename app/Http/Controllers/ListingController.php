<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\State;

class ListingController extends Controller
{
  public function add(){
    $states = State::all();
    return Auth::user() ? view('addlisting', [
      'states' => $states,
    ]) : redirect()->route('login', ['msg' => 'You have to be logged in to post items']);

    
  }
}
