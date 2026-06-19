<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvitationService
{
    public function create(User $user, array $data): Invitation
    {
        return DB::transaction(function () use ($user, $data) {

            if ($user->hasRole('SuperAdmin')) {

                $company = Company::create([
                    'name' => $data['company_name'],
                ]);

                return Invitation::create([
                    'company_id' => $company->id,
                    'invited_by' => $user->id,
                    'email' => $data['email'],
                    'role' => 'Admin',
                    'token' => Str::uuid()->toString(),
                    'expires_at' => now()->addDays(7),
                ]);
            }

            return Invitation::create([
                'company_id' => $user->company_id,
                'invited_by' => $user->id,
                'email' => $data['email'],
                'role' => $data['role'],
                'token' => Str::uuid()->toString(),
                'expires_at' => now()->addDays(7),
            ]);
        });
    }
}
