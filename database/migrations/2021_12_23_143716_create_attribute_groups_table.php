<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeGroupsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('attribute_groups', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->integer('position');
      $table->boolean('is_user_defined')->default(1);
      $table->foreignId('attribute_family_id')->index()->onDelete('cascade');
    });

    Schema::create('attribute_group_mappings', function (Blueprint $table) {
      $table->foreignId('attribute_id')->index()->onDelete('cascade');
      $table->foreignId('attribute_group_id')->index()->onDelete('cascade');
      $table->integer('position')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('attribute_group_mappings');

    Schema::dropIfExists('attribute_groups');
  }
}
