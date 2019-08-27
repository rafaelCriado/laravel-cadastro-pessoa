<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstado extends Migration
{
    public function up()
    {
        if(!Schema::hasTable('estados')) {
            Schema::create('estados', function (Blueprint $table) {
                $table->increments('id');
                $table->string('uf');
                $table->string('descricao');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
