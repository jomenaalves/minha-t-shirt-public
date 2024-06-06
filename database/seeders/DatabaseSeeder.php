<?php

namespace Database\Seeders;

use App\Models\Orders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            UserSeeder::class,
            RoleAndPermissionSeeder::class,
            StoriesSeeder::class,
            ProductsSeeder::class,
            CashierSeeder::class,
            CashierProductsSeeder::class,
            CashierPaymentsSeeder::class,
            CashierWithdrawalSeeder::class,
            RoleAndPermissionSeeder::class,
            OrderSeeder::class,
            OrderProductsSeeder::class,
        ]);
    }
}
