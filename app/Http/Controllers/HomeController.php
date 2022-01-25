<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Offer;

class HomeController extends Controller
{
  public function index(){
    return view('home', ['categories' => Category::all(), 'offers' => Offer::paginate(5)]);
  }
}
