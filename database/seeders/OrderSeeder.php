<?php

namespace Database\Seeders;

use App\Models\Orders;
use App\Services\OrderProducts\Services\OrderProductsService;
use App\Services\Orders\Services\OrderService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'order_number' => 1,
                'order_status' => 0,
                'client_document' => '44689507066',
                'client_register' => '151059305',
                'client_corporate_reason' => '',
                'client_state_registration' => '',
                'client_name' => 'Marcos Silva',            
                'client_email' => 'marcos@gmail.com',            
                'client_phone' => '19988210779',            
                'client_cep' => '13044491',            
                'client_address' => 'R. Dr. Oswaldo Adib Abib',            
                'client_number' => '473',            
                'client_complement' => 'Bloco 01 AP 606',            
                'client_neighborhood' => 'Pq. das Cachoeiras',            
                'client_city' => 'Campinas',            
                'client_state' => 'SP',            
            ],
            [
                'order_number' => 2,
                'order_status' => 1,
                'client_document' => '55918822000148',
                'client_register' => '',
                'client_corporate_reason' => 'IdealPix Comunicação Ltda',
                'client_state_registration' => '946013060541',
                'client_name' => 'IdealPix House',            
                'client_email' => 'idealpix@gmail.com',            
                'client_phone' => '19988210862',            
                'client_cep' => '13045529',            
                'client_address' => 'R. Joaquim D. Barbosa',            
                'client_number' => '8',            
                'client_complement' => '',            
                'client_neighborhood' => 'Jd Von Zubem',            
                'client_city' => 'Campinas',            
                'client_state' => 'SP',             
            ],
            [
                'order_number' => 3,
                'order_status' => 2,
                'client_document' => '62819462006',
                'client_register' => '260895179',
                'client_corporate_reason' => '',
                'client_state_registration' => '',
                'client_name' => 'Carla Maria',            
                'client_email' => 'carla@gmail.com',            
                'client_phone' => '19988210752',            
                'client_cep' => '13045529',            
                'client_address' => 'R. Joaquim D. Barbosa',            
                'client_number' => '8',            
                'client_complement' => '',            
                'client_neighborhood' => 'Jd Von Zubem',            
                'client_city' => 'Campinas',            
                'client_state' => 'SP',            
            ],
                    
        ];

        foreach($orders as $order) {
            $item = new Orders();
            $item->order_number = $order['order_number'];
            $item->order_status = $order['order_status'];
            $item->client_document = $order['client_document'];
            $item->client_register = $order['client_register'];
            $item->client_corporate_reason = $order['client_corporate_reason'];
            $item->client_state_registration = $order['client_state_registration'];
            $item->client_name = $order['client_name'];
            $item->client_email = $order['client_email'];
            $item->client_phone = $order['client_phone'];
            $item->client_cep = $order['client_cep'];
            $item->client_address = $order['client_address'];
            $item->client_number = $order['client_number'];
            $item->client_complement = $order['client_complement'];
            $item->client_neighborhood = $order['client_neighborhood'];
            $item->client_city = $order['client_city'];
            $item->client_state = $order['client_state'];

            $item->save();
        }    
    }
}
