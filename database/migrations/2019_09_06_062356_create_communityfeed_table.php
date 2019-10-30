<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityfeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communityfeed', function (Blueprint $table) {
            $table->Increments('threadID');
            $table->string('threadTopic')->unique();
            $table->text('threadContent');
            $table->string('slug');
            $table->integer('view_count')->default(0);
            $table->integer('categoryID')->unsigned();
            $table->foreign('categoryID')->references('categoryID')->on('threadcategories');
            $table->integer('userID')->unsigned();
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');;
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
        Schema::dropIfExists('communityfeed');
    }
}
