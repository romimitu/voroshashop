<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration
{
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slogan')->nullable();
            $table->text('notice')->nullable();
            $table->text('about')->nullable();
            $table->text('mission_vision')->nullable();
            $table->string('header_logo');
            $table->string('footer_logo');
            $table->string('address');
            $table->text('about_img')->nullable();
            $table->string('free_ship_upto');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('email');
            $table->string('mobile');
            $table->text('map');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}
