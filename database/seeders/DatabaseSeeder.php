<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Currency;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $arr = ["Factory new", "Slightly worn", "Moderatly worn", "Hightly worn", "For scrap"]; //seeding states
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

    $arr = ["CZK", "Dollar", "Euro"]; //seeding currecies
    foreach ($arr as $i) {
      $currency = new Currency;
      $currency->name = $i;
      $currency->save();
    }

    $arr = [ 
      "Computers" => [
        "icon" => "laptop"
      ],
      "Phones" => [
        "icon" => "phone"
      ],
      "Cars & Moto" => [
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
    // \App\Models\User::factory(10)->create();
  }
}
