<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeOptionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('attribute_options', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->integer('order')->nullable();
      $table->foreignId('attribute_id')->nullable()->index()->onDelete('cascade');
      $table->string('swatch_value')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('attribute_options');
  }
}
