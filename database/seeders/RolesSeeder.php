<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'Administrator',
            'Superadministrator',
            'Developer',
            'Dispatcher',
            'Driver'
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(['name' => $role], ['name' => $role]);
        }
    }
}
