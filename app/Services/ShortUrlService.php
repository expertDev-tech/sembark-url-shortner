<?php

namespace App\Services;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Support\Str;

class ShortUrlService
{
    public function create(User $user, array $data): ShortUrl
    {
        do {
            $shortCode = Str::random(6);
        } while (
            ShortUrl::where('short_code', $shortCode)->exists()
        );

        return ShortUrl::create([
            'company_id' => $user->company_id,
            'user_id' => $user->id,
            'original_url' => $data['original_url'],
            'short_code' => $shortCode,
        ]);
    }

    public function list(User $user)
    {
        $query = ShortUrl::with([
            'user',
            'company',
        ]);

        if ($user->can('view-all-short-urls')) {

            return $query->latest()->paginate(10);

        }

        if ($user->can('view-company-short-urls')) {

            return $query
                ->where('company_id', $user->company_id)
                ->latest()
                ->paginate(10);

        }

        return $query
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);
    }

    public function resolve(string $shortCode): ShortUrl
    {
        $shortUrl = ShortUrl::where(
            'short_code',
            $shortCode
        )->firstOrFail();

        $shortUrl->increment('hits');

        return $shortUrl;
    }
}
