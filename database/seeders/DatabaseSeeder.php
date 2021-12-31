<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\User::factory(10)->create();
    $this->call(AttributeFamilyTableSeeder::class);
    $this->call(AttributeGroupTableSeeder::class);
    $this->call(AttributeTableSeeder::class);
    $this->call(AttributeOptionTableSeeder::class);
    $this->call(CategoryTableSeeder::class);
  }
}
