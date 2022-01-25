<?php

namespace App\Http\Controllers;

use App\Mail\MessageToUser;
use App\Models\Category;
use App\Models\Offer;
use App\Models\User;
use App\Models\File;
use Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
    $offer = Offer::findOrFail($this->getIdFromTag($offerTag));
    $offer->tag = $this->getTagFromOffer($offer);
    
    //Mail::to('krybe120@gmail.cz')->send(new MessageToUser($offer, "kokot"));
    
    return view('offer', ["offer" => $offer]);
  }

  public function editOffer($offerTag){
    $offer = Offer::findOrFail($this->getIdFromTag($offerTag));
  }

  public function removeOffer($offerTag){
    $offer = $this->findOrFailOffer($this->getIdFromTag($offerTag));
    if(Auth::check() && Auth::id() === $offer->user_id || Auth::check() && Auth::user()->admin){
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

  private function getIdFromTag($tag){
    return explode("-", $tag)[0];
  }
  
  private function getTagFromOffer($offer){
    return $offer->id . "-" . str_replace(" ", "-", $offer->header);
  }

}
