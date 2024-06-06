<?php

namespace Database\Seeders;

use App\Models\Cashier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashiers = [
            [
                'date' => '2024-05-18',
                'note' => 'Observação 01',
                'sold' => 1840.20,
                'status' => false,            
            ],
            [
                'date' => '2024-05-19',
                'note' => 'Observação 02',
                'sold' => 1410.50,
                'status' => true,            
            ],
            [
                'date' => '2024-05-20',
                'note' => 'Observação 03',
                'sold' => 132.30,
                'status' => false,            
            ],
                       
        ];

        foreach($cashiers as $cashier) {
            $cash = new Cashier();
            $cash->date = $cashier['date'];
            $cash->note = $cashier['note'];
            $cash->sold = $cashier['sold'];
            $cash->status = $cashier['status'];
            $cash->save();
        }
    }
}
