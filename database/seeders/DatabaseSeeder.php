<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Currency;
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
    $arr = ["Factory new", "Slightly worn", "Moderatly worn", "Hightly worn", "For scrap"];
    foreach ($arr as $i) {
      $state = new State;
      $state->name = $i;
      $state->save();
    }

    $krybe = new User;
    $krybe->name = "Krybe";
    $krybe->password = '$2y$10$wDnIBGXOFvpKPVhozu3PueXxxLP28ZuIqQGZEvgf1jscdQHVqPWLm'; //abc123
    $krybe->save();

    $krybe = new Admin;
    $krybe->user_id = 1;
    $krybe->save();

    $arr = ["CZK", "Dollar", "Euro"];
    foreach ($arr as $i) {
      $currency = new Currency;
      $currency->name = $i;
      $currency->save();
    }
    // \App\Models\User::factory(10)->create();
  }
}
