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
    return view('addlisting', ['states' => State::all(), 'currencies' => Currency::all(), 'categories' => Category::all()]);
  }
  public function saveData(Request $request){
      $validated = $request->validate([
        'header' => 'string|max:40|min:4',
        'description' => 'string|max:500',
        'price' => 'integer|min:0|max:100000000',
        'state' => 'integer|min:0',
        'currency' => 'integer|min:0',
        'category' => 'integer|min:0',
        'mainimg' => 'mimes:jpeg,png,jpg|max:2048',
        'otherimg' => 'array|max:3',
        'otherimg.*' => 'mimes:jpeg,png,jpg|max:2048',
      ]);
      $o = new Offer;
      $o->header = $validated['header'];
      $o->description = $validated['description'];
      $o->price = $validated['price'];
      $o->state_id = $validated['state'];
      $o->currency_id = $validated['currency'];
      $o->category_id = $validated['category'];
      $o->user_id = Auth::user()->id;
      $o->save();

      $offerId = Offer::max('id');
      if (isset($validated['mainimg'])){
        $this->saveImg($validated['mainimg'], $offerId);
      } else {
        File::create([
          'name' => "no image",
          'url' => "https://dummyimage.com/200x200/ffffff/000000&text=No+image",
          'alt' => "no image",
          'offer_id' => $offerId,
        ]);
      }
      
      if (isset($validated['otherimg'])){
        foreach ($validated['otherimg'] as $img) {
          $this->saveImg($img, $offerId);
        }
      }
  }
  private function saveImg($inputImg, $offerId){
    $img = explode( ".", $inputImg->getClientOriginalName());
    $imgAlt = $img[0];
    $imgExtension = $img[1];
    $imgName = rand(111, 99999) . $imgAlt . time() .  "." . $imgExtension;
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
