<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiCep;

class RequisicoesController extends Controller
{
    //consulta cep
    public function cep($cep){
        $response = ApiCep::consulta($cep);
        return $this->formataResposta($response);
    }

    //formata o retorno 
    private function formataResposta($response){
        try {
            if((isset($response['erro']) and !empty($response['erro'])) or isset($response['response']['erro'])){
                return ['erro'=>'true'];
            }
            $objCEP = $response['response'];
            if($objCEP != null)
                return $objCEP;
            else
                return ['erro'=>'true'];
        } catch (\Throwable $th) {
            return ['erro'=>'true'];
        }
    }
}
