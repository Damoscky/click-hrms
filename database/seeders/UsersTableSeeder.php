<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staffRole = config('roles.models.role')::where('name', '=', 'Staff')->first();
        $clientRole = config('roles.models.role')::where('name', '=', 'Client')->first();
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $superadminRole = config('roles.models.role')::where('name', '=', 'Super Admin')->first();
        $employeeRole = config('roles.models.role')::where('name', '=', 'Employee')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Users
         *
         */
        if (config('roles.models.defaultUser')::where('email', '=', 'superadmin@click-hrm.co.uk')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Super Admin',
                'last_name'     => 'HRM',
                'phoneno' => '07577663344',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'superadmin@click-hrm.co.uk',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($superadminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'admin@click-hrm.co.uk')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Admin',
                'last_name'     => 'HRM',
                'phoneno' => '07788994488',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'admin@click-hrm.co.uk',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($adminRole);
            
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'employee@click-hrm.co.uk')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Employee',
                'last_name'     => 'HRM',
                'phoneno' => '0786553344',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'employee@click-hrm.co.uk',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($employeeRole);
            
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'user@click-hrm.co.uk')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'User',
                'last_name'     => 'HRM',
                'phoneno' => '09987663355',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'user@click-hrm.co.uk',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($userRole);
            
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'client@click-hrm.co.uk')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Client',
                'last_name'     => 'HRM',
                'phoneno' => '07855772211',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'client@click-hrm.co.uk',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($clientRole);
            
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'staff@click-hrm.co.uk')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Staff',
                'last_name'     => 'HRM',
                'phoneno' => '08766554433',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'staff@click-hrm.co.uk',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($staffRole);
            
        }

        
    }
}
