<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\User;

use Illuminate\Http\Request;

class OfferController extends Controller
{
  public function getOffers(Request $request)
  {
    $userId = $request->user;
    $catId = $request->category;
    $offers = !$catId ? ($userId ? Offer::where('user_id', $userId)->paginate(5) : Offer::paginate(5)) : Offer::where('category_id', $catId)->paginate(5);
    $categoryName = !$catId ? ($userId ? "Offers of " . User::find($userId)->user_name : "Home") : Category::find($catId)->name;
    if (count($offers) === 0){
      return $userId ? "<h3 class='ps-1 pt-1'>". User::find($userId)->user_name ." has no active offers</h3>" : "<h3 class='ps-1 pt-1'>There are no offers in $categoryName</h3>";
    }
    return view('assets.offers', ['offers' => $offers], ['category' => $categoryName]);
  }
  public function getOffer(Request $request, $offerTag){
    return view('offer', ["offer" => Offer::where('id', explode("-", $offerTag)[0])->first()]);
  }
}
