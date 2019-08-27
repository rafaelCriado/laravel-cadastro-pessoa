<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Debitos extends Migration{
    public function up(){
        if (!Schema::hasTable('debitos')) {
            Schema::create('debitos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('tipo');
                $table->string('descricao');
                $table->decimal('valor',10,2);
                $table->integer('pedido_id')->unsigned();
                
                $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
                $table->primary(['id','permissao_id']);
            });
        }
    }

    public function down(){
        Schema::dropIfExists('debitos');
    }
}