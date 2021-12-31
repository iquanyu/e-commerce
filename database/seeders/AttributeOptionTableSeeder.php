<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeOptionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('attribute_options')->delete();

    DB::table('attribute_options')->insert([
      [
        'id'           => '1',
        'name'   => '红色',
        'order'   => '1',
        'attribute_id' => '23',
      ], [
        'id'           => '2',
        'name'   => '绿色',
        'order'   => '2',
        'attribute_id' => '23',
      ], [
        'id'           => '3',
        'name'   => '黄色',
        'order'   => '3',
        'attribute_id' => '23',
      ], [
        'id'           => '4',
        'name'   => '黑色',
        'order'   => '4',
        'attribute_id' => '23',
      ], [
        'id'           => '5',
        'name'   => '白色',
        'order'   => '5',
        'attribute_id' => '23',
      ], [
        'id'           => '6',
        'name'   => 'S',
        'order'   => '1',
        'attribute_id' => '24',
      ], [
        'id'           => '7',
        'name'   => 'M',
        'order'   => '2',
        'attribute_id' => '24',
      ], [
        'id'           => '8',
        'name'   => 'L',
        'order'   => '3',
        'attribute_id' => '24',
      ], [
        'id'           => '9',
        'name'   => 'XL',
        'order'   => '4',
        'attribute_id' => '24',
      ]
    ]);
  }
}
