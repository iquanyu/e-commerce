<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attribute;

class AttributeOptionFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name'   => $this->faker->word,
      'order'   => $this->faker->randomDigit(),
      'attribute_id' => Attribute::factory(['swatch_type' => 'text']),
      'swatch_value' => null,
    ];
  }
}
