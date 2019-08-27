<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('pessoas')) {
            Schema::create('pessoas', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome');
                $table->string('cpf');
                $table->string('cep');
                $table->string('logradouro');
                $table->string('numero');
                $table->string('bairro');
                $table->string('cidade');
                $table->string('uf');
                $table->string('complemento');
                $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');

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
        Schema::dropIfExists('pessoas');
    }
}
