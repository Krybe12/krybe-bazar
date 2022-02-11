<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Category;
use App\Models\Offer;
use App\Models\File;
use App\Models\State;
use App\Models\User;

class StatsController extends Controller
{
  public function index()
  {
    $dataArr = [];
    array_push($dataArr,
    ["name" => "Registered users", "data" => User::count()],
    ["name" => "Number of offers", "data" => Offer::count()],
    ["name" => "Images uploaded", "data" => File::count()],
    ["name" => "Number of admins", "data" => Admin::count()],
    ["name" => "Number of categories", "data" => Category::count()],  
    );
    return view('stats', ["dataArr" => $dataArr]);
  }
}
