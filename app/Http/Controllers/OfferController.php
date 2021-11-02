<?php

namespace App\Http\Controllers;

use App\Models\Offer;

use Illuminate\Http\Request;

class OfferController extends Controller
{
  public function getOffers(Request $request)
  {
    $offers = !$request->category ? Offer::paginate(5) : Offer::where('category_id', $request->category)->paginate(5);
    return view('assets.offers', ['offers' => $offers]);
  }
}
