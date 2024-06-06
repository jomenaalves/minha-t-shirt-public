<?php

namespace Database\Seeders;

use App\Models\CashierPayments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashierPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            [
                'cashier_id' => 1,
                'method' => 'pix',
                'value' => 640.20,            
            ],
            [
                'cashier_id' => 1,
                'method' => 'credit_card',
                'value' => 1000.00,            
            ],
            [
                'cashier_id' => 1,
                'method' => 'debit_card',
                'value' => 200.00,            
            ],
            [
                'cashier_id' => 2,
                'method' => 'money',
                'value' => 140.20,            
            ],
            [
                'cashier_id' => 2,
                'method' => 'other',
                'value' => 1000.00,            
            ],
            [
                'cashier_id' => 3,
                'method' => 'debit_card',
                'value' => 200.00,            
            ],
            [
                'cashier_id' => 3,
                'method' => 'credit_card',
                'value' => 100.00,            
            ],
            [
                'cashier_id' => 3,
                'method' => 'transfer',
                'value' => 50.00,            
            ],                       
        ];

        foreach($payments as $payment) {
            $pay = new CashierPayments();
            $pay->cashier_id = $payment['cashier_id'];
            $pay->method = $payment['method'];
            $pay->value = $payment['value'];
            $pay->save();
        }
    }
}
