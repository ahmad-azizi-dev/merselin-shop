<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::findOrCreate('super-admin');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        $user = User::where('email', 'admin@admin.com')->first();
        if (empty($user)) {
            $user = User::factory()->create([  // create admin user
                'name'  => 'Admin User',
                'email' => 'admin@admin.com',
            ]);
        }
        $user->assignRole($role);
    }
}
