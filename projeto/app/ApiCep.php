<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiCep extends Model
{
    public static function consulta($cep){
        $curl = curl_init();

        $arrayCurl = [
            CURLOPT_URL => "https://viacep.com.br/ws/".$cep."/json/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "cache-control: no-cache"
            ),
        ];

        curl_setopt_array($curl, $arrayCurl);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
        }

        return [
            'erro' => $err,
            'response' => $response,
        ];
    }
}
