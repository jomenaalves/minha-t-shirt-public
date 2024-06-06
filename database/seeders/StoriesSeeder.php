<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Stores;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'name' => 'Loja 02 - Inicio Desenvolvimento',
                'slug' => 'loja-02-inicio-desenvolvimento',               
            ],
            [
                'name' => 'Loja Miller Mall',
                'slug' => 'loja-miller-mall',               
            ],
            [
                'name' => 'Estoque Miller Mall',
                'slug' => 'estoque-miller-mall',               
            ],            
        ];

        foreach($stores as $store) {
            $transaction = new Stores();
            $transaction->name = $store['name'];
            $transaction->slug = $store['slug'];           
            $transaction->save();
        }
    }
}
