<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $admin = Role::create(['name' => 'Admin']);
        $student = Role::create(['name' => 'Student']);
        

        // // Create permissions
        Permission::create(['name' => 'upload files']);
        Permission::create(['name' => 'edit files']);
        Permission::create(['name' => 'delete files']);
        Permission::create(['name' => 'download files']);
        Permission::create(['name' => 'create subjects']);
        Permission::create(['name' => 'edit subjects']);
        Permission::create(['name' => 'delete subjects']);
        // Assign permissions to roles
        $admin->givePermissionTo(['upload files', 
        'edit files', 
        'delete files',
        'download files', 
        'create subjects',
        'edit subjects',
        'delete subjects']);
        $student->givePermissionTo(['download files']);
    }
}
