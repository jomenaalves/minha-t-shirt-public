<?php

namespace Database\Seeders;

use App\Models\Stores;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store = Stores::factory(1)->create();

        User::factory(10)->create();
    }
}
