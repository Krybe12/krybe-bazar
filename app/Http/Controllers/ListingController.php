<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Category;
use App\Models\Offer;
use App\Models\File;
use App\Models\State;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
  public function add(){
    if (!Auth::user()->has_information){
      session(['destinationPage' => '/addlisting']);
      session()->flash('msg', 'You have to add your information in order to do that');
      return redirect('/addinformation');
    }
    return view('addlisting', ['states' => State::all(), 'currencies' => Currency::all(), 'categories' => Category::all()]);
  }

  public function saveEdit(Request $request, $tag){
    $validated = $this->validateRequest($request);
    $offer = Offer::findOrFail($this->getIdFromTag($tag));
    if (!$this->isAllowed($offer->user_id)){
      abort(403);
    }
    $id = $this->getIdFromTag($tag);
    $this->saveOfferFromValidated($validated, Offer::findOrFail($id));
    return redirect('/offer/' . $id . "-" . $validated['header']);
  }

  private function validateRequest($request){
    return $request->validate([
      'header' => 'string|max:40|min:4',
      'description' => 'string|max:500',
      'price' => 'integer|min:0|max:100000000',
      'state' => 'integer|min:0',
      'currency' => 'integer|min:0',
      'category' => 'integer|min:0',
      'mainimg' => 'mimes:jpeg,png,jpg|max:2048',
      'otherimg' => 'array|max:4',
      'otherimg.*' => 'mimes:jpeg,png,jpg|max:2048',
    ]);
  }

  private function saveOfferFromValidated($validated, $offer){
    $offer->header = $validated['header'];
    $offer->description = $validated['description'];
    $offer->price = $validated['price'];
    $offer->state_id = $validated['state'] ?? $offer->state_id;
    $offer->currency_id = $validated['currency'];
    $offer->category_id = $validated['category'] ?? $offer->category_id;
    $offer->user_id = $offer->user_id ?? Auth::user()->id;
    try {
      $offer->save();
    } catch (\Throwable $th) {
    }
  }

  public function saveData(Request $request){
      $validated = $this->validateRequest($request);

      $this->saveOfferFromValidated($validated, new Offer);

      $offerId = Offer::max('id');
      if (isset($validated['mainimg'])){
        $this->saveImg($validated['mainimg'], $offerId);
      } else {
        File::create([
          'name' => "no image",
          'url' => "https://dummyimage.com/500x500/ffffff/000.png&text=No-image",
          'alt' => "no image",
          'offer_id' => $offerId,
        ]);
      }
      
      if (isset($validated['otherimg'])){
        foreach ($validated['otherimg'] as $img) {
          $this->saveImg($img, $offerId);
        }
      }
      return redirect('/')->with('status', 'Listing successfully added! :)');
  }

  private function saveImg($inputImg, $offerId){
    $img = explode(".", $inputImg->getClientOriginalName());
    $imgAlt = $img[0];
    $path = $inputImg->store('images', 's3');
    $image = File::create([
      'name' => basename($path),
      'url' => Storage::disk('s3')->url($path),
      'alt' => $imgAlt,
      'offer_id' => $offerId,
    ]);
    
/*     $imgExtension = $img[1];
    $imgName = rand(111, 99999) . $imgAlt . time() .  "." . $imgExtension;
    $inputImg->storeAs('/public', $imgName);
    $url = Storage::url($imgName);
    File::create([
      'name' => $imgName,
      'url' => $url,
      'alt' => $imgAlt,
      'offer_id' => $offerId,
    ]); */
  }
}
