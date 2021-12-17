<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    foreach ($offers as $offer) {
      $offer->tag = $this->getTagFromOffer($offer);  
    }

    return view('assets.offers', ['offers' => $offers], ['category' => $categoryName]);
  }

  public function getOffer($offerTag){
    $offer = Offer::where('id', $this->getIdFromTag($offerTag))->first();
    $offer->tag = $this->getTagFromOffer($offer);
    return view('offer', ["offer" => $offer]);
  }

  public function editOffer($offerTag){
    $offer = $this->findOrFailOffer($this->getIdFromTag($offerTag));
  }

  public function removeOffer($offerTag){
    $offer = $this->findOrFailOffer($this->getIdFromTag($offerTag));
    if(Auth::check() && Auth::id() === $offer->user_id || Auth::check() && Auth::user()->admin){
      $offer->delete();
      return redirect('/')->with('status', 'Listing successfully deleted!');
    } else {
      abort(403);
    }
  }

  private function getIdFromTag($tag){
    return explode("-", $tag)[0];
  }
  
  private function getTagFromOffer($offer){
    return $offer->id . "-" . str_replace(" ", "-", $offer->header);
  }

  private function findOrFailOffer($offerId){
    return Offer::findOrFail($offerId);
  }

}
