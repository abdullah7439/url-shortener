<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShortUrl extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'original_url',
        'short_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getShortLinkAttribute()
    {
        return route('short.resolve', $this->short_code);
    }

    // SuperAdmin sees everything, Admin sees their company, Member sees only their own.
    public function scopeVisibleTo(Builder $query, User $user)
    {
        if ($user->isSuperAdmin()) {
            return $query;
        }

        if ($user->isAdmin()) {
            return $query->where('company_id', $user->company_id);
        }

        return $query->where('user_id', $user->id);
    }

    public static function generateCode(int $length = 7)
    {
        do {
            $code = Str::lower(Str::random($length));
        } while (static::where('short_code', $code)->exists());

        return $code;
    }
}
