<?php

namespace App;

use GuzzleHttp\Client;
use Carbon\Carbon;
use Hamcrest\Type\IsArray;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ApiBancoRendimento extends Model
{
    private $TOKEN = null;
    private $URL_ENDPOINT = null;
    private $URL_TOKEN_API = null;
    private $CLIENTE_ID = null;
    private $SECRET_ID = null;
    
    public function __construct()
    {
        //Consulta dados 
        $this->ConfiguracoesAPI();
    }
   
    public function ConfiguracoesAPI(){
        $credenciais         = Credencial::where('nome','ApiBancoRendimentoHomologacao')->first();
        $this->CLIENTE_ID    = $credenciais->ClientID;
        $this->SECRET_ID     = $credenciais->ClientSecret;
        $this->URL_ENDPOINT  = $credenciais->Endpoint;
        $this->URL_TOKEN_API = $credenciais->UrlAutenticacao;
    }

    public function credenciais(){
        return [
            $this->TOKEN,
            $this->CLIENTE_ID,
            $this->URL_ENDPOINT,
            $this->URL_TOKEN_API,
            $this->SECRET_ID,
        ];
    }

    //Retorna um renavam a partir da placa
    public function ConsultarPorPlaca($placa){
        return '12314123124';
    }

    public function ConsultaDebitos($placa){

        return [
            'DPVAT'=>[
                '2018'=>'45.72',
                '2019'=>'68.10'
            ],
            'IPVA' =>[
                '2019'=>'3737.25'
            ],
            'MULTAS'=>[
                '03/2018'=>'1000.52',
                '04/2019'=>'1328.00'
            ],
            'LICENCIAMENTO'=>'75.62',
            'TRANSFERENCIA'=>'0.00'
        ];
    }
}
