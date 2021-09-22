<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\State;

class ListingController extends Controller
{
  public function add(){   
    return view('addlisting', ['states' => State::all(), 'currencies' => Currency::all()]);  

    
  }
}
