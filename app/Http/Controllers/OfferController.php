<?php

namespace App\Http\Controllers;

use App\Mail\MessageToUser;
use App\Models\Currency;
use App\Models\Category;
use App\Models\Offer;
use App\Models\File;
use App\Models\State;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class OfferController extends Controller
{

  public function getOffers(Request $request)
  {
    $sort = $request->price !== 'asc' && $request->price !== 'desc' ? 'asc' : $request->price;
    $sortColumn = $request->price === 'asc' || $request->price === 'desc' ? 'price' : 'id';

    $stateId = ($st = State::find($request->wear)?->name) ? $request->wear : '%';

    $userId = $request->user;
    $catId = Category::where('name', '=', $request->category)->first()->id ?? null;
    $searchQuery = "%" . $request->search . "%" ?? "%";
    if (strlen($searchQuery) > 25) return;
    $offers = !$catId ? ($userId ? Offer::where('user_id', $userId)->paginate(5) : Offer::where('header', 'like', $searchQuery)->where('state_id', 'like', $stateId)->orderBy($sortColumn, $sort)->paginate(5)) : Offer::where('category_id', $catId)->where('header', 'like', $searchQuery)->where('state_id', 'like', $stateId)->orderBy($sortColumn, $sort)->paginate(5);
    $categoryName = !$catId ? ($userId ? "Offers of " . User::find($userId)->user_name : "Home") : Category::find($catId)->name;

    if (count($offers) === 0){
      return $userId ? "<h3 class='ps-1 pt-1'>". User::find($userId)->user_name ." has no active offers</h3>" : "<h3 class='ps-1 pt-1'>No results " . $this->getInfoString($categoryName, $request->search, $st) . "</h3>";
    }

    foreach ($offers as $offer) {
      $offer->tag = $this->getTagFromOffer($offer);  
    }

    return view('assets.offers', ['offers' => $offers], ['category' => $categoryName]);
  }

  public function getOffer($offerTag){
    $offer = Offer::findOrFail($this->getIdFromTag($offerTag));
    $offer->tag = $this->getTagFromOffer($offer);
        
    return view('offer', ["offer" => $offer]);
  }

  public function editOffer($offerTag){
    $offer = Offer::findOrFail($this->getIdFromTag($offerTag));

    if($this->isAllowed($offer->user_id)){
      return view('editlisting', ["offer" => $offer, 'currencies' => Currency::all()]);
    } else {
      abort(403);
    }

  }

  public function removeOffer($offerTag){
    $offer = Offer::findOrFail($this->getIdFromTag($offerTag));
    
    if($this->isAllowed($offer->user_id)){
      $images = $offer->images()->get();
      foreach($images as $image){
        Storage::disk('s3')->delete("images/" . $image->name);
      }
      $offer->delete();
      return redirect('/')->with('status', 'Listing successfully deleted!');
    } else {
      abort(403);
    }
    
  }

  private function getInfoString($cat, $search, $st){
    if (!$cat && !$search) return "";
    return "(" . ($cat ? "Category: $cat" : "") . ($search ? "; Search: $search" : "") . ($st ? "; Wear: $st" : "") . ")";
  }
  
}
