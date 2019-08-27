<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapelPermissao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('papel_permissao')) {
            Schema::create('papel_permissao', function (Blueprint $table) {
                $table->integer('permissao_id')->unsigned();
                $table->integer('papel_id')->unsigned();

                $table->foreign('permissao_id')->references('id')->on('permissaos')->onDelete('cascade');
                $table->foreign('papel_id')->references('id')->on('papels')->onDelete('cascade');


                $table->primary(['permissao_id', 'papel_id']);
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
        Schema::dropIfExists('papel_permissao');
    }
}
