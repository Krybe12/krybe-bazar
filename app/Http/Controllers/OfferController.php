<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;

use Illuminate\Http\Request;

class OfferController extends Controller
{
  public function getOffers(Request $request)
  {
    $catId = $request->category;
    $offers = !$catId ? Offer::paginate(5) : Offer::where('category_id', $catId)->paginate(5);
    $categoryName = !$catId ? "Home" : Category::where('id', $request->category)->first()->name;
    if (count($offers) === 0){
      return "<h3 class='ps-1 pt-2'>There are no offers in $categoryName</h3>";
    }
    return view('assets.offers', ['offers' => $offers], ['category' => $categoryName]);
  }
}
