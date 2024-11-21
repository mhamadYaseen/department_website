<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignAdminRoleSeeder extends Seeder
{
    public function run()
    {
        try {
            // Create admin role if it doesn't exist
            $adminRole = Role::firstOrCreate(['name' => 'admin']);

            // Find user with ID 1
            $admin = User::findOrFail(1);

            // Assign role
            if (!$admin->hasRole('admin')) {
                $admin->assignRole('admin');
                $this->command->info('Admin role assigned successfully.');
            } else {
                $this->command->info('User already has admin role.');
            }
        } catch (\Exception $e) {
            $this->command->error('Error assigning admin role: ' . $e->getMessage());
        }
    }
}