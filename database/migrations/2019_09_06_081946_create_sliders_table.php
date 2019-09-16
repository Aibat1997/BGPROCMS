<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('slider_id');
            $table->text('slider_text_ru')->nullable();
            $table->text('slider_text_kz')->nullable();
            $table->text('slider_text_en')->nullable();
            $table->string('slider_url')->nullable();
            $table->string('slider_image_ru')->nullable();
            $table->string('slider_image_kz')->nullable();
            $table->string('slider_image_en')->nullable();
            $table->unsignedInteger('slider_position');
            $table->unsignedInteger('sort_num');
            $table->boolean('is_show')->default(1);
            $table->timestamps();
            $table->date('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
