<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('pedidos')) {
            Schema::create('pedidos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome');
                $table->string('cpf');
                $table->string('uf');
                $table->string('placa');
                
                $table->string('cep');
                $table->string('logradouro');
                $table->string('numero');
                $table->string('bairro');
                $table->string('cidade');
                $table->string('uf');
                $table->string('complemento');
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
