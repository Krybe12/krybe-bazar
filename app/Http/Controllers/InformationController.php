<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{
  public function index(){
    return view('addinformation');
  }
  public function saveInformation(Request $request){
    $validated = $request->validate([
      '_name' => 'string|min:3|max:50|required',
      '_email' => 'required|email',
      '_telprefix' => 'max:10',
      '_tel' => 'max:20'
    ]);
    Auth::user()->name = $validated["_name"];
    Auth::user()->email = $validated["_email"];
    if (isset($validated["_tel"])){
      $tel = $validated["_tel"];
      if (isset($validated["_telprefix"])){
        $tel = $validated["_telprefix"] . " " . $tel;
      }
      Auth::user()->phone_number = $tel;
    }
    Auth::user()->email = $validated["_email"];
    Auth::user()->has_information = 1;
    Auth::user()->save();
    return redirect( session('destinationPage') ? session('destinationPage') : "/home");
  }
}
