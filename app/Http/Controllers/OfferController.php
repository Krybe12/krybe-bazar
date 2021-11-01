<?php

namespace App\Http\Controllers;

use App\Models\Offer;

use Illuminate\Http\Request;

class OfferController extends Controller
{
  public function getOffers($catId = false)
  {
    $offers = !$catId ? Offer::paginate(5) : Offer::where('category_id', $catId)->paginate(5);

    return view('assets.offers', ['offers' => $offers]);
  }
}
