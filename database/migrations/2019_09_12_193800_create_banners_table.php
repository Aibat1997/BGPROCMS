<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('banner_id');
            $table->string('banner_image')->nullable();
            $table->string('banner_name')->nullable();
            $table->string('banner_url')->nullable();
            $table->unsignedBigInteger('banner_rubric_id');
            $table->unsignedBigInteger('banner_position_id');
            $table->boolean('is_show')->default(1);
            $table->timestamps();

            $table->foreign('banner_position_id')->references('position_id')->on('positions')->onDelete('cascade');
            $table->foreign('banner_rubric_id')->references('rubric_id')->on('rubrics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
