<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function index(Request $request, $profileStr = ""){
    $userData = $profileStr ? User::where('id', explode('-', $profileStr)[0])->first() : Auth::user();
    if (!$userData) abort(404);
    $title = "Profile of " . $userData->user_name;
    return view('profile', ['user' => $userData], ['titleText' => $title]);
  }
}
