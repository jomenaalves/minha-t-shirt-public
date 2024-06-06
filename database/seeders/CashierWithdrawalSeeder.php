<?php

namespace Database\Seeders;

use App\Models\CashierWithdrawal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashierWithdrawalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $withdrawals = [
            [
                'cashier_id' => 1,
                'value' => 56,30,
                'note' => 'Retirada 01',           
            ],
            [
                'cashier_id' => 2,
                'value' => 106,30,
                'note' => 'Retirada 02',           
            ],                    
        ];

        foreach($withdrawals as $withdrawal) {
            $prod = new CashierWithdrawal();
            $prod->cashier_id = $withdrawal['cashier_id'];
            $prod->value = $withdrawal['value'];
            $prod->note = $withdrawal['note'];
            $prod->save();
        }
    }
}
