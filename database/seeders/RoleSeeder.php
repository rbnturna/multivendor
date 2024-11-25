<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $superAdminRole = Role::create(['name' => 'superadmin']);
        $vendorRole = Role::create(['name' => 'vendor']);
        $adminRole = Role::create(['name' => 'admin']);

        // Create multiple users and assign roles
        $superAdminUsers = User::factory()->count(2)->create(); // Create 2 Super Admins
        foreach ($superAdminUsers as $user) {
            $user->assignRole($superAdminRole);
        }

        $vendorUsers = User::factory()->count(3)->create(); // Create 3 Vendors
        foreach ($vendorUsers as $user) {
            $user->assignRole($vendorRole);
        }

        $adminUsers = User::factory()->count(2)->create(); // Create 2 Admins
        foreach ($adminUsers as $user) {
            $user->assignRole($adminRole);
        }
    }
}
