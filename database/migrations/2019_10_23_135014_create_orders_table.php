<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('invoice_no', 32);
            $table->date('invoice_date', 32);
            $table->string('customer_name', 128);
            $table->string('customer_mobile', 32);
            $table->string('customer_email', 64)->default('n/a');
            $table->string('address', 128);
            $table->string('city', 32);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('shipping_fee', 10, 2)->default(0.00);
            $table->decimal('paid_amount', 10, 2);
            $table->string('payment_status', 16)->default('Unpaid');
            $table->text('payment_details')->nullable();
            $table->string('operational_status', 16)->default('Pending');
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('processed_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
