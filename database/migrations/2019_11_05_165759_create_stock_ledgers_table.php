<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockLedgersTable extends Migration
{
    public function up()
    {
        Schema::create('stock_ledgers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no', 32);
            $table->string('tr_no', 32);
            $table->date('invoice_date', 64);
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedInteger('product_id');
            $table->decimal('purchase_price', 10, 2)->default(0.00);
            $table->decimal('sale_price', 10, 2)->default(0.00);
            $table->string('stock_status', 16)->default('0');
            $table->bigInteger('inqty')->default('0');
            $table->bigInteger('outqty')->default('0');
            $table->bigInteger('prtn_qty')->default('0');
            $table->bigInteger('srtn_qty')->default('0');
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('processed_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('stock_ledgers');
    }
}
