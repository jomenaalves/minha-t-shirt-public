<?php

namespace Database\Seeders;

use App\Models\CashierProducts ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashierProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
        $products = [
            [
                'cashier_id' => 1,
                'product_id' => 1,
                'store_id' => 1, 
                'quantity' => 3,
                'price' => 120.10           
            ],
            [
                'cashier_id' => 1,
                'product_id' => 2,
                'store_id' => 1, 
                'quantity' => 1,
                'price' => 99.00           
            ],
            [
                'cashier_id' => 1,
                'product_id' => 3,
                'store_id' => 1, 
                'quantity' => 5,
                'price' => 60.00           
            ],
            [
                'cashier_id' => 2,
                'product_id' => 2,
                'store_id' => 3, 
                'quantity' => 3,
                'price' => 150.10           
            ],
            [
                'cashier_id' => 2,
                'product_id' => 4,
                'store_id' => 2, 
                'quantity' => 1,
                'price' => 79.00           
            ],
            [
                'cashier_id' => 2,
                'product_id' => 5,
                'store_id' => 1, 
                'quantity' => 5,
                'price' => 59.00           
            ],
            [
                'cashier_id' => 3,
                'product_id' => 3,
                'store_id' => 2, 
                'quantity' => 4,
                'price' => 150.10           
            ],
            [
                'cashier_id' => 3,
                'product_id' => 5,
                'store_id' => 1, 
                'quantity' => 8,
                'price' => 79.00           
            ],
            [
                'cashier_id' => 3,
                'product_id' => 1,
                'store_id' => 1, 
                'quantity' => 15,
                'price' => 59.00           
            ],
                                  
        ];

        foreach($products as $product) {
            $prod = new CashierProducts();
            $prod->cashier_id = $product['cashier_id'];
            $prod->product_id = $product['product_id'];
            $prod->store_id = $product['store_id'];
            $prod->quantity = $product['quantity'];
            $prod->price = $product['price'];
            $prod->save();
        }
    }
}
