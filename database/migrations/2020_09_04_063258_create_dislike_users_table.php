<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDislikeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dislike_users', function (Blueprint $table) {
            $table->id();
            $table->integer('dislike_by')->unsigned();
            $table->integer('dislike_to')->unsigned();
            $table->timestamps();

            $table->foreign('dislike_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('dislike_to')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dislike_users');
    }
}
