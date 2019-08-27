<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = 'pessoas';

    protected $fillable = [
        'nome',
        'cpf',
        'uf',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'complemento'
    ];

    /*public function documentos(){
        return $this->hasMany(Documentos::class);
    }*/
}
