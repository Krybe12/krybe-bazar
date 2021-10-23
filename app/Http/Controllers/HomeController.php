<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Category;
use App\Models\Offer;
use App\Models\File;
use App\Models\State;

class HomeController extends Controller
{
  public function index(){
    return view('home', ['states' => State::all(), 'currencies' => Currency::all(), 'categories' => Category::all()]);
  }
}
