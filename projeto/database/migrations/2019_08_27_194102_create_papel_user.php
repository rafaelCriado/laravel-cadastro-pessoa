<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapelUser extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('papel_user')) {
            Schema::create('papel_user', function (Blueprint $table) {
                $table->integer('user_id')->unsigned();
                $table->integer('papel_id')->unsigned();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('papel_id')->references('id')->on('papels')->onDelete('cascade');

                $table->primary(['user_id', 'papel_id']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('papel_user');
    }
}
