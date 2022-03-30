<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'permission_create',
            'permission_edit',
            'permission_destroy',
            'permission_access',

            'place_create',
            'place_edit',
            'place_access',

            'sizes_create',
            'sizes_edit',
            'sizes_access',

            'customer_access',

            'caption_create',
            'caption_edit',
            'caption_access',

            'order_access',
            'order_details',

            'employee_create',
            'employee_edit',
            'employee_access',

            'owners_create',
            'owners_edit',
            'owners_access',

            'categories_create',
            'categories_edit',
            'categories_access',


            ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name'    => 'admins'
            ]);
        }
        $superAdmin =  Role::create([
            'name' => 'Super Admin',
            'guard_name'    => 'admins' // Dah 3al 7sab al guard name aly fe config auth
        ]);

        foreach ($permissions as $permission) {
            $superAdmin->givePermissionTo($permission);
        }
    }
}
