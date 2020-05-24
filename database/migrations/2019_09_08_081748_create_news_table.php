<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('news_id');
            $table->string('news_name_ru')->nullable();
            $table->string('news_name_kz')->nullable();
            $table->string('news_name_en')->nullable();
            $table->text('news_desc_ru')->nullable();
            $table->text('news_desc_kz')->nullable();
            $table->text('news_desc_en')->nullable();
            $table->string('news_image')->nullable();
            $table->text('news_meta_description_ru')->nullable();
            $table->text('news_meta_description_kz')->nullable();
            $table->text('news_meta_description_en')->nullable();
            $table->string('news_meta_keywords_ru')->nullable();
            $table->string('news_meta_keywords_kz')->nullable();
            $table->string('news_meta_keywords_en')->nullable();
            $table->string('tag_ru')->nullable();
            $table->string('tag_kz')->nullable();
            $table->string('tag_en')->nullable();
            $table->date('news_date')->nullable();
            $table->string('news_lang');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('news_rubric_id');
            $table->boolean('is_show')->default(1);
            $table->timestamps();
            $table->date('deleted_at')->nullable();

            $table->foreign('author_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('news_rubric_id')->references('rubric_id')->on('rubrics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
