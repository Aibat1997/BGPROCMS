<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_positions', function (Blueprint $table) {
            $table->bigIncrements('np_id');
            $table->unsignedBigInteger('np_news_id');
            $table->unsignedBigInteger('np_position_id');
            $table->timestamps();

            $table->foreign('np_news_id')->references('news_id')->on('news')->onDelete('cascade');
            $table->foreign('np_position_id')->references('position_id')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_positions');
    }
}
