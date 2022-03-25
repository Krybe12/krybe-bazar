<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Currency;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\User;
use App\Models\File;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $arr = ["Factory new", "Slightly worn", "Moderatly worn", "Highly worn", "For scrap"]; //seeding states
    foreach ($arr as $i) {
      $state = new State;
      $state->name = $i;
      $state->save();
    }

    $krybe = new User;
    $krybe->user_name = "Krybe";
    $krybe->password = '$2y$10$wDnIBGXOFvpKPVhozu3PueXxxLP28ZuIqQGZEvgf1jscdQHVqPWLm'; //abc123
    $krybe->save();

    $krybe = new Admin;
    $krybe->user_id = 1;
    $krybe->save();

    $admin = new User;
    $admin->user_name = "Admin";
    $admin->password = '$2y$10$wDnIBGXOFvpKPVhozu3PueXxxLP28ZuIqQGZEvgf1jscdQHVqPWLm'; //abc123
    $admin->save();

    $admin = new Admin;
    $admin->user_id = 2;
    $admin->save();

    $franta = new User;
    $franta->user_name = "Franta";
    $franta->has_information = 1;
    $franta->password = '$2y$10$wDnIBGXOFvpKPVhozu3PueXxxLP28ZuIqQGZEvgf1jscdQHVqPWLm'; //abc123
    $franta->name = "Franta Bezny Uzivatel";
    $franta->email = "franta.bezny@uzivatel.cz";
    $franta->phone_number = "+420 123 456 789";
    $franta->save();

 /*    $arr = ["CZK", "Dollar", "Euro"]; //seeding currecies
    $sign = ["Kč", "&#36;", "&#128;"]; */
    $arr = [ 
      "Euro" => [
        "code" => "&#128;"
      ]
    ];
/*     $arr = [ 
      "CZK" => [
        "code" => "Kč"
      ],
      "Euro" => [
        "code" => "&#128;"
      ],
      "Dollars" => [
        "code" => "&#36;"
      ] //seeding currencies
    ]; */
    foreach (array_keys($arr) as $i) {
      $currency = new Currency;
      $currency->name = $i;
      $currency->code = $arr[$i]["code"];
      $currency->save();
    }

    $arr = [ 
      "Computers" => [
        "icon" => "laptop"
      ],
      "Phones" => [
        "icon" => "phone"
      ],
      "Cars and Moto" => [
        "icon" => "truck"
      ],
      "Household Supplies" => [
        "icon" => "house-door"
      ],
      "Appliances" => [
        "icon" => "plug"
      ],
      "Other" => [
        "icon" => "question-square"
      ] //seeding categories
    ];
    foreach (array_keys($arr) as $i) {
      $category = new Category;
      $category->name = $i;
      $category->icon = $arr[$i]["icon"];
      $category->save();
    }

    $numOfOffers = 10;
    \App\Models\Offer::factory($numOfOffers)->create();
/*     for ($i=1 ; $i < $numOfOffers; $i++) { 
      $img = new File;
      $img->offer_id = $i;
      $img->name = "No image";
      $img->alt = "No image";

      $img->save();
    } */
  }
}
