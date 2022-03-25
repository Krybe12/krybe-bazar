<?php

namespace Database\Factories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class OfferFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  protected $model = Offer::class;

  public function definition()
  {
    return [
      'header' => $this->faker->words(3, true),
      'description' => $this->faker->sentence(12),
      'price' => $this->faker->randomNumber(5, false),
      'user_id' => 3,
      'state_id' => $this->faker->numberBetween(1, 5),
      'category_id' => $this->faker->numberBetween(1, 5),
      'currency_id' => 1,
    ];
  }
}
