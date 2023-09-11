<?php

namespace Database\Seeders;

use App\Models\ClientRecord;
use App\Models\CompanySetting;
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
        $superadminRole = config('roles.models.role')::where('name', '=', 'Super Admin Access')->first();
        $employeeRole = config('roles.models.role')::where('name', '=', 'Employee')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $workforceRole = config('roles.models.role')::where('name', '=', 'Workforce Admin Access')->first();
        $businessdevRole = config('roles.models.role')::where('name', '=', 'Business Development Admin Access')->first();
        $recruitmentRole = config('roles.models.role')::where('name', '=', 'Recruitment Admin Access')->first();
        $permissions = config('roles.models.permission')::all();

        $workforceAccess = config('roles.models.permission')::where('description', 'Shift Management')
        ->orWhere('description', 'Manage Shift Management')->orWhere('description', 'Dashboard Management')->orWhere('description', 'Client Management')
        ->orWhere('description', 'Employee Management')->get();

        $recruitmentAccess = config('roles.models.permission')::where('description', 'Employee Management')
        ->orWhere('description', 'Manage Employee Management')->orWhere('description', 'Dashboard Management')->get();

        $businessDevAccess = config('roles.models.permission')::where('description', 'Client Management')
        ->orWhere('description', 'Manage Client Management')->orWhere('description', 'Dashboard Management')->get();

        /*
         * Add Users
         *
         */
        if (config('roles.models.defaultUser')::where('email', '=', 'superadmin@clickhrm.co.uk')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Super Admin',
                'last_name'     => 'HRM',
                'phoneno' => '07577663344',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'superadmin@clickhrm.co.uk',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($superadminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'stephanie@click-operations.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Stephanie',
                'last_name'     => 'Ariemu',
                'phoneno' => '07770962153',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'stephanie@click-operations.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($superadminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'lekan.ayuba@click-operations.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Lekan',
                'last_name'     => 'Ayuba',
                'phoneno' => '07389184954',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'lekan.ayuba@click-operations.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($superadminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'esther@click-operations.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Esther',
                'last_name'     => 'Agbaje',
                'phoneno' => '07389188854',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'esther@click-operations.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($workforceRole);
            foreach ($workforceAccess as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'rebecca.timibe@click-operations.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Rebecca',
                'last_name'     => 'Tim-Ibe',
                'phoneno' => '07389294954',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'rebecca.timibe@click-operations.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($recruitmentRole);
            foreach ($recruitmentAccess as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'daniel@click-operations.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Daniel',
                'last_name'     => 'Ayodele',
                'phoneno' => '07389184926',
                'is_active' => true,
                'is_verified' => true,
                'can_login' => true,
                'is_completed' => true,
                '2fa' => true,
                'email'    => 'daniel@click-operations.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($businessdevRole);
            foreach ($businessDevAccess as $permission) {
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

        // if (config('roles.models.defaultUser')::where('email', '=', 'client@click-hrm.co.uk')->first() === null) {
        //     $newUser = config('roles.models.defaultUser')::create([
        //         'first_name'     => 'Client',
        //         'last_name'     => 'HRM',
        //         'phoneno' => '07855772211',
        //         'is_active' => true,
        //         'is_verified' => true,
        //         'can_login' => true,
        //         'is_completed' => true,
        //         '2fa' => true,
        //         'email'    => 'client@click-hrm.co.uk',
        //         'password' => bcrypt('password'),
        //     ]);

        //     $newUser->attachRole($clientRole);

        //     $clientRecord = ClientRecord::create([
        //         'client_id' => $newUser->id,
        //         'user_id' => $newUser->id,
        //         'company_name' => "Click HRM Client",
        //         'address' => "No 4, Horton Street",
        //         'post_code' => "LS12 2PJ",
        //         'city' => "Leeds",
        //         'county' => "West Yorkshire",
        //         'country' => "United Kingdom",
        //     ]);
            
        // }

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

        $companySetting = CompanySetting::create([
            'standard_hca' => '14.5',
            'senior_hca' => '15.5',
            'currency' => '£',
            'rgn' => '30',
            'kitchen_assistant' => '14.5',
            'laundry' => '14.5',
            'email' => 'info@click-operations.com',
            'phoneno' => '08099887744',
            'account_name' => 'Click Operations (UK) Limited',
            'account_number' => '3764885',
            'sort_code' => '09-00-78',
            'bank_name' => 'Lloyds Bank',
            'iban' => 'LYD-8475-958585-384848',
            'bic' => 'LYDL98766',
            'address' => 'Hyde Park Rd, Burley, Leeds LS6 1PX, UK',
            'post_code' => 'LS11 7nd',
            'city' => 'Leeds',
            'county' => '',
            'signature' => '',
            'rules_regulations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',

        ]);

        
    }
}
