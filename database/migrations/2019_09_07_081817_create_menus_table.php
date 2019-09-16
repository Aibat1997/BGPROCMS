<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('menu_id');
            $table->string('menu_name_ru')->nullable();
            $table->string('menu_name_kz')->nullable();
            $table->string('menu_name_en')->nullable();
            $table->string('menu_url')->nullable();
            $table->boolean('is_show_main')->default(1);
            $table->boolean('is_show')->default(1);
            $table->boolean('is_sub')->default(0);
            $table->unsignedBigInteger('main_menu_id')->nullable();
            $table->unsignedBigInteger('menu_page_id')->nullable();
            $table->timestamps();
            
            $table->foreign('menu_page_id')->references('page_id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
