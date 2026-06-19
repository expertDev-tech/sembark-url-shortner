<?php

namespace App\Policies;

use App\Models\User;

class InvitationPolicy
{
    public function create(User $user): bool
    {
        return $user->can('invite-admin') || $user->can('invite-member');
    }

    public function inviteAdmin(User $user): bool
    {
        return $user->can('invite-admin');
    }

    public function inviteMember(User $user): bool
    {
        return $user->can('invite-member');
    }
}
