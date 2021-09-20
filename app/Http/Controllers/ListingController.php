<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListingController extends Controller
{
  public function add(){
    return view('addlisting');
  }
}
