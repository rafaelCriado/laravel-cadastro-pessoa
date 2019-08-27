<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'nome',
        'tipo',
        'arquivo',
        'arquivo_tipo'
    ];

    public function pedido(){
        return $this->hasMany(Pedido::class);
    }

}
