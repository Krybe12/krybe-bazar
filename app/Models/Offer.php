<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\State;
use App\Models\Currency;
use App\Models\User;


class Offer extends Model
{
  use HasFactory;

  protected $with = ['images', 'currency'];

  public function images()
  {
    return $this->hasMany(File::class);
  }
  public function currency()
  {
    return $this->belongsTo(Currency::class);
  }
  public function state()
  {
    return $this->belongsTo(State::class);
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
