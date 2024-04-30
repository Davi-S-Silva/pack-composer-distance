<?php

namespace DaviSSilva;

class CalculateDistance{
    private $base_endpoint = "https://api.mapbox.com/directions/v5/mapbox/driving/";
    private $token = "pk.eyJ1IjoiZGF2aXNhbnRvcyIsImEiOiJja3l1aGx5MDkxbmlvMnBwZWZpazIxMjdsIn0.XWtWHGFCbb_LWv-yUkCgIg";
    private  $result;
    public function __construct($origem, $destino){
        $url = $this->base_endpoint .$origem.";".$destino."?access_token=".$this->token ;
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            // Permite obter o resultado
            CURLOPT_RETURNTRANSFER => 1,
        ]);
        $resposta = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $this->result = (object)$resposta;
    }
    public function showDistance(){
        return $this->result->routes[0]['distance'];
    }
    public function showWaypoints(){
        $arr = ['origem'=>$this->result->waypoints[0]['name'], 'destino'=>$this->result->waypoints[1]['name']];
        return (object)$arr;
    }
}

