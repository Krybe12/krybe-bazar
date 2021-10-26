<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;


class Offer extends Model
{
    use HasFactory;
    public function images()
    {
        return $this->hasMany(File::class);
    }
}
