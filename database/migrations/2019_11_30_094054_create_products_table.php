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
        if(!Schema::hasTable('products')){
            Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_row_id');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_height')->nullable();
            $table->string('product_width')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_sku');
            $table->string('product_image')->nullable();
            $table->string('product_description')->nullable();
            $table->tinyInteger('product_rating')->default(0);
            $table->tinyInteger('is_latest')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->timestamps();

            });

        }
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
