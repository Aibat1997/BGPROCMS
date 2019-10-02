<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_positions', function (Blueprint $table) {
            $table->bigIncrements('bp_id');
            $table->unsignedBigInteger('bp_banner_id');
            $table->unsignedBigInteger('bp_position_id');
            $table->timestamps();

            $table->foreign('bp_banner_id')->references('banner_id')->on('banners')->onDelete('cascade');
            $table->foreign('bp_position_id')->references('position_id')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_positions');
    }
}
