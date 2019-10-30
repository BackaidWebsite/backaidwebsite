<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->Increments('articleID');
            $table->string('articleTitle')->unique();
            $table->text('articleContent');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('status');
            $table->integer('view_count')->default(0);
            $table->integer('categoryID')->unsigned();
            $table->foreign('categoryID')->references('categoryID')->on('articlecategories');
            $table->integer('userID')->unsigned();
            $table->foreign('userID')->references('userID')->on('users');
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
        Schema::dropIfExists('article');
    }
}
