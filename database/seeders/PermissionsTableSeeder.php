<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $Permissionitems = [
            [
                'name'        => 'Can View Users',
                'slug'        => 'view.users',
                'description' => 'User Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Users',
                'slug'        => 'create.users',
                'description' => 'User Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Users',
                'slug'        => 'edit.users',
                'description' => 'User Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Users',
                'slug'        => 'delete.users',
                'description' => 'User Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Employee',
                'slug'        => 'view.employee',
                'description' => 'Employee Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Employee',
                'slug'        => 'create.employee',
                'description' => 'Employee Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Employee',
                'slug'        => 'edit.employee',
                'description' => 'Employee Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Employee',
                'slug'        => 'delete.employee',
                'description' => 'Employee Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Client',
                'slug'        => 'view.client',
                'description' => 'Client Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Client',
                'slug'        => 'create.client',
                'description' => 'Client Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Client',
                'slug'        => 'edit.client',
                'description' => 'Client Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Client',
                'slug'        => 'delete.client',
                'description' => 'Client Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Timesheet',
                'slug'        => 'view.timesheet',
                'description' => 'Timesheet Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Timesheet',
                'slug'        => 'create.timesheet',
                'description' => 'Timesheet Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Timesheet',
                'slug'        => 'edit.timesheet',
                'description' => 'Timesheet Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Timesheet',
                'slug'        => 'delete.timesheet',
                'description' => 'Timesheet Management',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Can View Shift',
                'slug'        => 'view.shift',
                'description' => 'Shift Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Shift',
                'slug'        => 'create.shift',
                'description' => 'Shift Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Shift',
                'slug'        => 'edit.shift',
                'description' => 'Shift Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Shift',
                'slug'        => 'delete.shift',
                'description' => 'Shift Management',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Can View Leave',
                'slug'        => 'view.leave',
                'description' => 'Leave Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Leave',
                'slug'        => 'create.leave',
                'description' => 'Leave Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Leave',
                'slug'        => 'edit.leave',
                'description' => 'Leave Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Leave',
                'slug'        => 'delete.leave',
                'description' => 'Leave Management',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Can View Report',
                'slug'        => 'view.report',
                'description' => 'Report Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Report',
                'slug'        => 'create.report',
                'description' => 'Report Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Report',
                'slug'        => 'edit.report',
                'description' => 'Report Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Report',
                'slug'        => 'delete.report',
                'description' => 'Report Management',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Can View Dashboard',
                'slug'        => 'view.dashboard',
                'description' => 'Dashboard Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Dashboard',
                'slug'        => 'create.dashboard',
                'description' => 'Dashboard Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Dashboard',
                'slug'        => 'edit.dashboard',
                'description' => 'Dashboard Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Dashboard',
                'slug'        => 'delete.dashboard',
                'description' => 'Dashboard Management',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Can View Staff',
                'slug'        => 'view.staff',
                'description' => 'Staff Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Staff',
                'slug'        => 'create.staff',
                'description' => 'Staff Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Staff',
                'slug'        => 'edit.staff',
                'description' => 'Staff Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Staff',
                'slug'        => 'delete.staff',
                'description' => 'Staff Management',
                'model'       => 'Permission',
            ],


            [
                'name'        => 'Can View Department',
                'slug'        => 'view.department',
                'description' => 'Department Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Department',
                'slug'        => 'create.department',
                'description' => 'Department Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Department',
                'slug'        => 'edit.department',
                'description' => 'Department Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Department',
                'slug'        => 'delete.department',
                'description' => 'Department Management',
                'model'       => 'Permission',
            ],

            [
                'name'        => 'Can View Reports',
                'slug'        => 'edit.reports',
                'description' => 'Reports Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Export Reports',
                'slug'        => 'export.reports',
                'description' => 'Reports Management',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Manage Settings',
                'slug'        => 'manage.settings',
                'description' => 'Settings Management',
                'model'       => 'Permission',
            ],

            
        ];

        /*
         * Add Permission Items
         *
         */
        foreach ($Permissionitems as $Permissionitem) {
            $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
            if ($newPermissionitem === null) {
                $newPermissionitem = config('roles.models.permission')::create([
                    'name'          => $Permissionitem['name'],
                    'slug'          => $Permissionitem['slug'],
                    'description'   => $Permissionitem['description'],
                    'model'         => $Permissionitem['model'],
                ]);
            }
        }
    }
}
