<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_data', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('price');
            $table->string('special_price');
            $table->string('image');
            $table->string('category');
            $table->string('subcategory');
            $table->string('remark');
            $table->string('brand');
            $table->string('star')->nullable();
            $table->string('product_code');
            $table->string('image_one');
            $table->string('image_two');
            $table->string('image_three');
            $table->string('image_four');
            $table->string('short_description');
            $table->string('color');
            $table->string('size');
            $table->text('long_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_data');
    }
}
