<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'store_id' => 1,
                'name' => 'T-SHIRT P',
                'barcode' => '78989894561',
                'system_code' => '12',            
            ],
            [
                'store_id' => 1,
                'name' => 'T-SHIRT M',
                'barcode' => '78989894562',
                'system_code' => '13',            
            ],
            [
                'store_id' => 1,
                'name' => 'T-SHIRT G',
                'barcode' => '78989894563',
                'system_code' => '14',            
            ],
            [
                'store_id' => 1,
                'name' => 'T-SHIRT GG',
                'barcode' => '78989894564',
                'system_code' => '15',            
            ],
            [
                'store_id' => 1,
                'name' => 'CROPPED ELÁSTICO',
                'barcode' => '78989894565',
                'system_code' => '16',            
            ],
            [
                'store_id' => 1,
                'name' => 'REGATA',
                'barcode' => '78989894566',
                'system_code' => '17',            
            ],           
            [
                'store_id' => 1,
                'name' => 'MANGA LONGA',
                'barcode' => '78989894567',
                'system_code' => '18',            
            ],           
        ];

        foreach($products as $product) {
            $prod = new Products();
            $prod->store_id = $product['store_id'];
            $prod->name = $product['name'];
            $prod->barcode = $product['barcode'];
            $prod->system_code = $product['system_code'];
            $prod->save();
        }    
    }
}
