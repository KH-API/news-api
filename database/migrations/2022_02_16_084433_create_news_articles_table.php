<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned();
            $table->string('title', 255);
            $table->string('description', 255);
            $table->string('article_slug', 100);
            $table->string('article_photo', 100);
            $table->text('content');
            $table->json('tag')->nulable();
            $table->json('seo_keyword')->nullable();
            $table->integer('view_counter')->unsigned();
            $table->boolean('is_active')->deafult(true);
            $table->timestamps();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_articles');
    }
};
