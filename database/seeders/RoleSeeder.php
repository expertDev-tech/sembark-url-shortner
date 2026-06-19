<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate([
            'name' => 'SuperAdmin'
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'Admin'
        ]);

        $member = Role::firstOrCreate([
            'name' => 'Member'
        ]);

        $superAdmin->syncPermissions([
            'invite-admin',
            'view-all-short-urls',
        ]);

        $admin->syncPermissions([
            'invite-admin',
            'invite-member',
            'create-short-url',
            'view-company-short-urls',
        ]);

        $member->syncPermissions([
            'create-short-url',
            'view-own-short-urls',
        ]);
    }
}
