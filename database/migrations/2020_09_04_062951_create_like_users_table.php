<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_users', function (Blueprint $table) {
            $table->id();
            $table->integer('like_by')->unsigned();
            $table->integer('like_to')->unsigned();
            $table->tinyInteger('match_status')->default(0);
            $table->timestamps();

            $table->foreign('like_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('like_to')
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
        Schema::dropIfExists('like_users');
    }
}
