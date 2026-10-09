<?php

namespace App\Repositories;

use App\Models\ShortUrl;
use App\Models\User;

class ShortUrlRepository
{
    // Short urls the user is allowed to see according to their role
    public function getVisibleTo(User $user)
    {
        return ShortUrl::visibleTo($user)
            ->with(['user', 'company'])
            ->latest('id')
            ->get();
    }

    public function create(User $user, string $originalUrl)
    {
        return ShortUrl::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'original_url' => $originalUrl,
            'short_code' => ShortUrl::generateCode(),
        ]);
    }

    public function findByCodeOrFail(string $code)
    {
        return ShortUrl::where('short_code', $code)->firstOrFail();
    }
}
