<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmpTradingaccsTable extends Migration
{
    public function up()
    {
        Schema::create('tmp_trading_accs', function (Blueprint $table) {
            $table->tinyInteger('slno')->default(1);
            $table->string('code', 32);
            $table->string('particulars', 32);
            $table->decimal('bal', 10, 2)->default(0.00);
            $table->tinyInteger('status')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tmp_trading_accs');
    }
}
