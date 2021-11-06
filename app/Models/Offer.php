<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\Currency;


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
}
