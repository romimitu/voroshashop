<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactsTable extends Migration
{
    public function up()
    {
        Schema::create('transacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tr_no', 32);
            $table->date('tr_date', 64);
            $table->unsignedBigInteger('chart_of_account_id');
            $table->decimal('debit', 10, 2)->default(0.00);
            $table->decimal('credit', 10, 2)->default(0.00);
            $table->string('details', 256)->default('0');
            $table->string('voucher_type', 128)->default('0');
            $table->string('ref_no', 32);
            $table->string('remark', 256)->default('0');
            $table->foreign('chart_of_account_id')->references('id')->on('chart_of_accounts')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('transacts');
    }
}
