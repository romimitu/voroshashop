<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseLedgersTable extends Migration
{
    public function up()
    {
        Schema::create('purchase_ledgers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('tr_no', 32);
            $table->string('invoice_no', 32);
            $table->date('invoice_date', 64);
            $table->decimal('payable_amount', 10, 2)->default(0.00);
            $table->decimal('less_amount', 10, 2)->default(0.00);
            $table->decimal('paid_amount', 10, 2)->default(0.00);
            $table->decimal('return_amount', 10, 2)->default(0.00);
            $table->string('payment_status', 16)->default('pending');
            $table->string('status', 64)->default('purchase');
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('processed_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_ledgers');
    }
}
