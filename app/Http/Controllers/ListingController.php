<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Offer;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\State;

class ListingController extends Controller
{
  public function add(){   
    return view('addlisting', ['states' => State::all(), 'currencies' => Currency::all()]);
  }
  public function saveData(Request $request){
    if ($request->hasFile('mainimg') && $request->file('mainimg')->isValid()) {
      $validated = $request->validate([
        'header' => 'string|max:40|min:4',
        'description' => 'string|max:500',
        'price' => 'integer|min:0|max:100000000',
        'state' => 'integer|min:0',
        'currency' => 'integer|min:0',
        'mainimg' => 'mimes:jpeg,png,jpg|max:1024',
        'otherimg' => 'array|max:6',
        'otherimg.*' => 'mimes:jpeg,png,jpg|max:1024',
      ]);
      $o = new Offer;
      $o->header = $validated['header'];
      $o->description = $validated['description'];
      $o->price = $validated['price'];
      $o->state_id = $validated['state'];
      $o->currency_id = $validated['currency'];
      $o->save();
      $offerId = Offer::max('id');
      $this->saveImg($validated['mainimg'], $offerId);
      foreach ($validated['otherimg'] as $img) {
        $this->saveImg($img, $offerId);
      }

    };
  }
  private function saveImg($inputImg, $offerId){
    $img = explode( ".", $inputImg->getClientOriginalName());
    $imgAlt = $img[0];
    $imgExtension = $img[1];
    $imgName = rand(111, 999999) . $imgAlt . rand(111, 999999) .  "." . $imgExtension;
    
    $inputImg->storeAs('/public', $imgName);
    $url = Storage::url($imgName);
    File::create([
      'name' => $imgName,
      'url' => $url,
      'alt' => $imgAlt,
      'offer_id' => $offerId,
    ]);
  }
}
