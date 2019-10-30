<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useroles', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('userID')->unsigned();
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');;
            $table->integer('rolesID')->unsigned();
            $table->foreign('rolesID')->references('rolesID')->on('roles')->onDelete('cascade');;
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
        Schema::dropIfExists('useroles');
    }
}
