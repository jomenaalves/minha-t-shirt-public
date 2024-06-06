<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {     
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();       

        $webPermissions = [
            'products_web'                  => ['access','create','edit','delete'],
            'stock_web'                     => ['access','create','edit','delete'],
            'cash_register_web'             => ['access','create','edit','delete'],
            'to_pay_web'                    => ['access','create','edit','delete'],
            'users_web'                     => ['access','create','edit','delete'],
            'reports_web'                   => ['access','create','edit','delete'],
            'orders_web'                    => ['access','create','edit','delete'],
            'settings_nfe_web'              => ['access','create','edit','delete'],
            'nfe_web'                       => ['access','create','edit','delete'],
            'movement_history_web'          => ['access','create','edit','delete'],
          
        ];
        $appPermissions = [
            'products_app'                  => ['access','create','edit','delete'],
            'stocks_app'                    => ['access','create','edit','delete'],
            'cash_register_app'             => ['access','create','edit','delete'],
            'freight_app'                   => ['access','create','edit','delete'],
            'orders_app'                    => ['access','create','edit','delete'],
        ];

        $normalPermissions = [
            ...$webPermissions,
            ...$appPermissions,
        ];

        try {
           DB::beginTransaction();

            foreach ($normalPermissions as $permission => $actions) {
                foreach($actions as $action){
                    Permission::firstOrCreate(['name' => "$permission.$action"]);
                }
            }

            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->givePermissionTo(Permission::all());
            } 
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }    
    }
}
