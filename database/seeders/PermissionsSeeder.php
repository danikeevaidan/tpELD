<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'view_dashboard',
            'manage_users',
            'view_reports',
            'create_tasks',
            'log_hours',
            'edit_own_profile',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        // Получаем роли
        $administrator = Role::where('name', 'Administrator')->first();
        $superadministrator = Role::where('name', 'Superadministrator')->first();
        $developer = Role::where('name', 'Developer')->first();
        $dispatcher = Role::where('name', 'Dispatcher')->first();
        $driver = Role::where('name', 'Driver')->first();

        $administrator->permissions()->sync([
            Permission::where('name', 'view_dashboard')->first()->id,
            Permission::where('name', 'manage_users')->first()->id,
            Permission::where('name', 'view_reports')->first()->id,
            Permission::where('name', 'edit_own_profile')->first()->id,
        ]);

        $superadministrator->permissions()->sync([
            Permission::where('name', 'view_dashboard')->first()->id,
            Permission::where('name', 'manage_users')->first()->id,
            Permission::where('name', 'view_reports')->first()->id,
            Permission::where('name', 'edit_own_profile')->first()->id,
        ]);

        $developer->permissions()->sync([
            Permission::where('name', 'view_dashboard')->first()->id,
            Permission::where('name', 'create_tasks')->first()->id,
            Permission::where('name', 'edit_own_profile')->first()->id,
        ]);

        $dispatcher->permissions()->sync([
            Permission::where('name', 'view_dashboard')->first()->id,
            Permission::where('name', 'view_reports')->first()->id,
            Permission::where('name', 'create_tasks')->first()->id,
            Permission::where('name', 'edit_own_profile')->first()->id,
        ]);

        $driver->permissions()->sync([
            Permission::where('name', 'view_dashboard')->first()->id,
            Permission::where('name', 'log_hours')->first()->id,
            Permission::where('name', 'edit_own_profile')->first()->id,
        ]);
    }
}
