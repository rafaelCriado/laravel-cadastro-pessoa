<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Documentos extends Migration
{
    public function up(){
        if (!Schema::hasTable('documentos')) {
            Schema::create('documentos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('tipo');
                //$table->text('arquivo');
                $table->string('arquivo_tipo');
                $table->integer('pedido_id')->unsigned();
                $table->timestamps();
                
                $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            });

            DB::statement("ALTER TABLE documentos ADD arquivo LONGBLOB");
        }


    }

    public function down(){
        Schema::dropIfExists('documentos');
    }
}
