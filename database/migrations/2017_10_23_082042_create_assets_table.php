<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('assets', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('category_id')->unsigned()->nullable();
         $table->string('name');
         $table->string('serial_number')->unique()->nullable();
         $table->string('eas_tag')->unique();
         $table->boolean('status')->default(0);
         $table->timestamps();
         $table->softDeletes();
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::dropIfExists('assets');
   }
}
