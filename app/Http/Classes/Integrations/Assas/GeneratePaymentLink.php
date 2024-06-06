<?php 

namespace App\Http\Classes\Integrations\Assas;

use GuzzleHttp\Exception\GuzzleException;

class GeneratePaymentLink {

    private $secret; 
    private $url;

    public function __construct()
    {
        $this->secret = env('ASAAS_API_KEY');
        $this->url = 'https://sandbox.asaas.com/api/v3/paymentLinks';

    }

    public function generatePaymentLink(String $cpf, $value)
    {
        $payload = [
            "billingType" => "UNDEFINED",
            "description" => $cpf,
            "chargeType" => "INSTALLMENT",
            "name" => "Pagamento de pedido",
            "value" => $value,
            "dueDateLimitDays" => 1,
            "maxInstallmentCount" => 1
        ];

        try {
            $client = new \GuzzleHttp\Client();
    
            $response = $client->request('POST',  $this->url, [
                'body' => json_encode($payload),
                'headers' => [
                  'accept' => 'application/json',
                  'access_token' => $this->secret,
                  'content-type' => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return [
                'url' => $data['url'],
                'id' => $data['id']
            ];
            

        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage());
        }
    
    }
}