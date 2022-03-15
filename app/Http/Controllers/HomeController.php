<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Offer;
use App\Models\State;

class HomeController extends Controller
{
  public function index(){
    return view('home', ['categories' => Category::all(), 'offers' => Offer::paginate(5), 'states' => State::all()]);
  }
}
