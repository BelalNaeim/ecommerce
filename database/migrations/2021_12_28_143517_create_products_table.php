<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('category_id');
            $table->Integer('subcategory_id')->nullable();
            $table->Integer('brand_id')->nullable();
            $table->string('product_name');
            $table->string('Product_code');
            $table->string('Product_quantitiy');
            $table->text('Product_details');
            $table->string('Product_color');
            $table->string('Product_size');
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('video_link')->nullable();
            $table->Integer('main_slider')->nullable();
            $table->Integer('hot_deal')->nullable();
            $table->Integer('best_rated')->nullable();
            $table->Integer('mid_slider')->nullable();
            $table->Integer('hot_new')->nullable();
            $table->Integer('trend')->nullable();
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
            $table->Integer('status')->nullable();
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
        Schema::dropIfExists('products');
    }
}
