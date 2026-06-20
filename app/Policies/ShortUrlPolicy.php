<?php

namespace App\Policies;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShortUrlPolicy
{
    public function create(User $user): bool
    {
        return $user->can('create-short-url');
    }

    public function viewAny(User $user): bool
    {
        return $user->can('view-all-short-urls')
            || $user->can('view-company-short-urls')
            || $user->can('view-own-short-urls');
    }

    public function view(User $user, ShortUrl $shortUrl): bool
    {
        if ($user->can('view-all-short-urls')) {
            return true;
        }

        if ($user->can('view-company-short-urls')) {
            return $user->company_id === $shortUrl->company_id;
        }

        if ($user->can('view-own-short-urls')) {
            return $user->id === $shortUrl->user_id;
        }

        return false;
    }
}
