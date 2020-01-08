<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('title', 128)->unique();
            $table->longText('description')->nullable();
            $table->string('sku', 128);
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->unsignedInteger('size_id')->default(0);;
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            $table->unsignedInteger('color_id')->default(0);;
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->decimal('sales_price', 8, 2);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
