<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeFamilyTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    DB::table('attribute_families')->delete();

    DB::table('attribute_families')->insert([
      [
        'id'              => '1',
        'code'            => 'default',
        'name'            => '默认',
        'status'          => '0',
        'is_user_defined' => '1',
      ]
    ]);

    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
