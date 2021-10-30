<?php

namespace App\Http\Controllers;

use App\Models\Offer;

use Illuminate\Http\Request;

class OfferController extends Controller
{
  public function getOffers($catId = false)
  {
    $offers = !$catId ? Offer::all() : Offer::where('category_id', $catId)->get();

    return view('assets.offers', ['offers' => $offers]);
  }
}
