<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatus extends Migration
{
    public function up(){
        if(!Schema::hasTable('status')) {
            Schema::create('status', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome');
                $table->string('descricao');
                $table->timestamps();
            });
        }
    }

    public function down(){
        Schema::dropIfExists('status');
    }
}
