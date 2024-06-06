<?php

namespace App\Http\Classes\Integrations;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;

class CepPromisse
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getAddressByCep(string $zipcode): PromiseInterface
    {
        $zipcode = preg_replace('/[^0-9]/', '', $zipcode);
    
        if (strlen($zipcode) !== 8) {
            throw new \Exception('CEP inválido');
        }
    
        $url = "viacep.com.br/ws/{$zipcode}/json/";
    
        return $this->client->getAsync($url)
            ->then(function ($response) {
                $data = json_decode($response->getBody(), true);
    
                return [
                    'zipcode' => $data['cep'],
                    'address' => $data['logradouro'],
                    'neighborhood' => $data['bairro'],
                    'city' => $data['localidade'],
                    'state' => $data['uf'],
                ];
            });
    }
    
}