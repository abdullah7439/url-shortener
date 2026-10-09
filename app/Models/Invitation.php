<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'email',
        'role',
        'token',
        'invited_by',
        'accepted_at',
    ];

    protected function casts(): array
    {
        return [
            'accepted_at' => 'datetime',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function acceptUrl()
    {
        return route('invitations.accept', $this->token);
    }
}
