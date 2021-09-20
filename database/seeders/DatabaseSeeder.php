<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\State;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $arr = ["Factory New", "Minimal Wear", "Field-Testes", "Well-Worn", "Scrap"];
    foreach ($arr as $i) {
      $state = new State;
      $state->name = $i;
      $state->save();
    }
    // \App\Models\User::factory(10)->create();
    /*         DB::table('states')->insert(['name' => "Nový"]);
        DB::table('states')->insert(['name' => "Lehce opotřebený"]);
        DB::table('states')->insert(['name' => "Opotřebný"]);
        DB::table('states')->insert(['name' => "Velmi opotřebený"]);
        DB::table('states')->insert(['name' => "Na součástky"]); */
  }
}
