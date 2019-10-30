<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlecommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articlecomment', function (Blueprint $table) {
            $table->Increments('commentID');
            $table->text('comment');
            $table->integer('articleID')->unsigned();
            $table->integer('userID')->unsigned();
            $table->foreign('articleID')->references('articleID')->on('article')->onDelete('cascade');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articlecomment');
    }
}
