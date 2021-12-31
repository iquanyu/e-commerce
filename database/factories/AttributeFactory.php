<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{

  /**
   * @var array
   */
  protected $states = [
    'validation_numeric',
    'validation_email',
    'validation_decimal',
    'validation_url',
    'required',
    'unique',
    'filterable',
    'configurable',
  ];
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $types = [
      'text',
      'textarea',
      'price',
      'boolean',
      'select',
      'multiselect',
      'datetime',
      'date',
      'image',
      'file',
      'checkbox',
    ];

    return [
      'name'                => $this->faker->word,
      'code'                => $this->faker->word,
      'type'                => array_rand($types),
      'validation'          => '',
      'position'            => $this->faker->randomDigit,
      'is_required'         => false,
      'is_unique'           => false,
      'is_configurable'     => false,
      'is_user_defined'     => true,
      'is_visible_on_front' => true,
      'swatch_type'         => null,
    ];
  }


  public function validation_numeric(): AttributeFactory
  {
    return $this->state(function (array $attributes) {
      return [
        'validation' => 'numeric',
      ];
    });
  }

  public function validation_email(): AttributeFactory
  {
    return $this->state(function (array $attributes) {
      return [
        'validation' => 'email',
      ];
    });
  }

  public function validation_decimal(): AttributeFactory
  {
    return $this->state(function (array $attributes) {
      return [
        'validation' => 'decimal',
      ];
    });
  }

  public function validation_url(): AttributeFactory
  {
    return $this->state(function (array $attributes) {
      return [
        'validation' => 'url',
      ];
    });
  }

  public function required(): AttributeFactory
  {
    return $this->state(function (array $attributes) {
      return [
        'is_required' => true,
      ];
    });
  }

  public function unique(): AttributeFactory
  {
    return $this->state(function (array $attributes) {
      return [
        'is_unique' => true,
      ];
    });
  }

  public function filterable(): AttributeFactory
  {
    return $this->state(function (array $attributes) {
      return [
        'is_filterable' => true,
      ];
    });
  }

  public function configurable(): AttributeFactory
  {
    return $this->state(function (array $attributes) {
      return [
        'is_configurable' => true,
      ];
    });
  }
}
