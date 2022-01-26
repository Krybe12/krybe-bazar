<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  protected function getIdFromTag($tag)
  {
    return explode("-", $tag)[0];
  }

  protected function getTagFromOffer($offer)
  {
    return $offer->id . "-" . str_replace(" ", "-", $offer->header);
  }

  protected function isAllowed($offerUserId)
  {
    return Auth::check() && Auth::id() === $offerUserId || Auth::check() && Auth::user()->admin;
  }
}
