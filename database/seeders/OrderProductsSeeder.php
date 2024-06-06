<?php

namespace Database\Seeders;

use App\Models\OrderProducts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'order_id' => 1,
                'product_id' => 1,
                'price' => 100.00,
                'quantity' => 3,       
            ],
            [
                'order_id' => 2,
                'product_id' => 3,
                'price' => 80.00,
                'quantity' => 2,              
            ],
            [
                'order_id' => 3,
                'product_id' => 5,
                'price' => 120.00,
                'quantity' => 4,              
            ],
                    
        ];

        foreach($orders as $order) {
            $item = new OrderProducts();
            $item->order_id = $order['order_id'];
            $item->product_id = $order['product_id'];
            $item->price = $order['price'];
            $item->quantity = $order['quantity'];
            $item->save();
        }   
    }
}
