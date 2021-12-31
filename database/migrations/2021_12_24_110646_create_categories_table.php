<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('categories', function (Blueprint $table) {
      $table->id();
      $table->text('name');
      $table->string('slug');
      $table->integer('position')->default(0);
      $table->string('image')->nullable();
      $table->boolean('status')->default(0)->comment('Visible In Menu');
      $table->text('description')->nullable();
      $table->text('meta_title')->nullable();
      $table->text('meta_description')->nullable();
      $table->text('meta_keywords')->nullable();
      $table->string('display_mode')->default('products_and_description')->nullable();
      $table->json('additional')->nullable();
      $table->nestedSet();
      $table->timestamps();
    });
    Schema::create('category_filterable_attributes', function (Blueprint $table) {
      $table->foreignId('category_id')->onDelete('cascade')->constrained();
      $table->foreignId('attribute_id')->onDelete('cascade')->constrained();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('categories', function (Blueprint $table) {
      $table->dropNestedSet();
    });
    Schema::dropIfExists('category_filterable_attributes');
    Schema::dropIfExists('categories');
  }
}
