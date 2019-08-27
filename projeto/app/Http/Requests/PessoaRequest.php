<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'nome'  => 'required|string',
            'cpf'   => 'required|unique:pessoas,cpf',
            'cep'   => 'required',
            'endereco'=> 'required',
            'bairro'    => 'required',
            'cidade'    => 'required',
            'numero'    => 'required',
            'estado'    => 'required'
        ];
    }

    public function messages(){
        return [
            'nome.required'         => 'O nome é obrigatório!',
            'nome.string'           => 'Nome informado inválido!',
            'cep.required'          => 'O cep é obrigatório!',
            'endereco.required'     => 'O endereço é obrigatório!',
            'bairro.required'       => 'O bairro é obrigatório!',
            'cidade.required'       => 'A cidade é obrigatório!',
            'numero.required'       => 'O numero é obrigatório!',
            'estado.required'       => 'O estado é obrigatório!',
            'cpf.required'          => 'O CPF é obrigatório',
            'cpf.unique'            => 'Esse CPF já está cadastrado',
        ];
    }
}
