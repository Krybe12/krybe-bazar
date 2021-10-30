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

/*   function index()
  {
   $data = Offer::paginate(5);
   return view('pagination', ['offers' => $data]);
  } */

  function fetch_data(Request $request)
  {
 
   //if($request->ajax()) {
    $data = Offer::paginate(5);
    return view('assets.offers', ['offers' => $data]);
   }
  //}
}
