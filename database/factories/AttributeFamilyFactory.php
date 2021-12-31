<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFamilyFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name'            => $this->faker->word(),
      'code'            => $this->faker->word(),
      'is_user_defined' => rand(0, 1),
      'status'          => 0,
    ];
  }
}
