<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
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
        'mainimg' => 'mimes:jpeg,png,jpg|max:1024',
        'otherimg' => 'array|max:6',
        'otherimg.*' => 'mimes:jpeg,png,jpg|max:1024',
      ]);
      foreach($validated['otherimg'] as $val){
        var_dump($val->extension());
      }
      dd($validated['otherimg']);
    };
  }
}
