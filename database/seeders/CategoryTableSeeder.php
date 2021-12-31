<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('categories')->delete();

    $now = Carbon::now();

    DB::table('categories')->insert([
      [
        'id'         => '1',
        'name'             => 'Root',
        'slug'             => 'root',
        'description'      => 'Root',
        'meta_title'       => '',
        'meta_description' => '',
        'meta_keywords'    => '',
        'position'   => '1',
        'image'      => NULL,
        'status'     => '1',
        '_lft'       => '1',
        '_rgt'       => '14',
        'parent_id'  => NULL,
        'created_at' => $now,
        'updated_at' => $now,
      ]
    ]);
    $men = Category::create([
      'id'         => '2',
      'name'             => '男士',
      'slug'             => 'men',
      'description'      => '男士',
      'meta_title'       => '男士',
      'meta_description' => '男士',
      'meta_keywords'    => '男士',
      'position'   => '2',
      'image'      => NULL,
      'status'     => '1',
      'parent_id'  => 1,
      'created_at' => $now,
      'updated_at' => $now,
    ]);

    $women = Category::create([
      'id'         => '3',
      'name'             => '女士',
      'slug'             => 'women',
      'description'      => '女士',
      'meta_title'       => '女士',
      'meta_description' => '女士',
      'meta_keywords'    => '女士',
      'position'   => '3',
      'image'      => NULL,
      'status'     => '1',
      'parent_id'  => 1,
      'created_at' => $now,
      'updated_at' => $now,
    ]);

    $shoes = Category::create([
      'id'         => '4',
      'name'             => '球鞋',
      'slug'             => 'shoes',
      'description'      => '球鞋',
      'meta_title'       => '球鞋',
      'meta_description' => '球鞋',
      'meta_keywords'    => '球鞋',
      'position'   => '4',
      'image'      => NULL,
      'status'     => '1',
      'parent_id'  => 2,
      'created_at' => $now,
      'updated_at' => $now,
    ]);

    Category::fixTree();
  }
}
