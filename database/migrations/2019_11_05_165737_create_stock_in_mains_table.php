<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInMainsTable extends Migration
{
    public function up()
    {
        Schema::create('stock_in_mains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('invoice_no', 32);
            $table->decimal('total_price', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0.00);
            $table->bigInteger('total_product');
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('processed_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_in_mains');
    }
}
