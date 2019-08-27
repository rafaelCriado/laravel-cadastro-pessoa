<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapel extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('papels')) {
            Schema::create('papels', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome');
                $table->string('descricao')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('papels');
    }
}
