<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartOfAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 32);
            $table->string('title', 32);
            $table->string('type', 56);
            $table->tinyInteger('status')->default(1);
            $table->string('pay_type', 56);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('chart_of_accounts');
    }
}
