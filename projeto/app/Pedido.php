<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'nome',
        'cpf',
        'uf',
        'placa'
    ];

    public function documentos(){
        return $this->hasMany(Documentos::class);
    }
}
