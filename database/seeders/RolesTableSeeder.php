<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'name'        => 'Super Admin Access',
                'slug'        => 'superadmin',
                'description' => 'Super Admin Role',
                'level'       => 1,
            ],
            [
                'name'        => 'Recruitment Admin Access',
                'slug'        => 'recruitment',
                'description' => 'Recruitment Admin Role',
                'level'       => 2,
            ],
            [
                'name'        => 'Business Development Admin Access',
                'slug'        => 'businessdevelopment',
                'description' => 'Business Development Admin Role',
                'level'       => 3,
            ],
            [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 4,
            ],
            [
                'name'        => 'Employee',
                'slug'        => 'employee',
                'description' => 'Employee Role',
                'level'       => 5,
            ],
            [
                'name'        => 'Client',
                'slug'        => 'client',
                'description' => 'Client Role',
                'level'       => 6,
            ],
            [
                'name'        => 'Staff',
                'slug'        => 'staff',
                'description' => 'Staff Role',
                'level'       => 7,
            ],
            [
                'name'        => 'User',
                'slug'        => 'user',
                'description' => 'User Role',
                'level'       => 8,
            ],
            [
                'name'        => 'Workforce Admin Access',
                'slug'        => 'workforce',
                'description' => 'Workforce Admin Role',
                'level'       => 3,
            ],
            [
                'name'        => 'Unverified',
                'slug'        => 'unverified',
                'description' => 'Unverified Role',
                'level'       => 0,
            ],
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $RoleItem['name'],
                    'slug'          => $RoleItem['slug'],
                    'description'   => $RoleItem['description'],
                    'level'         => $RoleItem['level'],
                ]);
            }
        }
    }
}
