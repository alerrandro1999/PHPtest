<?php

namespace App\WebService;

class ViaCEP{

    public static function consultaCep($cep){

        //Instancia do cURL
        $curl = curl_init();

        //Parametros da chamada
        curl_setopt_array($curl, [
            CURLOPT_URL => 'viacep.com.br/ws/'.$cep.'/xml',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        //Execução
        $respon = curl_exec($curl);

        //Fechamento da instancia
        curl_close($curl);

        //Armazenamento do XML
        $xml = simplexml_load_string($respon);

        return $xml;
    }
}