<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'superadmin@sembark.com';

        $user = User::where('email', $email)->first();

        if (! $user) {
            DB::insert(
            "INSERT INTO users
            (name, email, password, created_at, updated_at)
            VALUES (?, ?, ?, NOW(), NOW())",
            [
                'Super Admin',
                $email,
                bcrypt('password'),
            ]
            );

            $user = User::where('email', $email)->first();
        }

        $user->syncRoles(['SuperAdmin']);

    }
}
