<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getByCompanyWithUrlCount(?int $companyId)
    {
        return User::where('company_id', $companyId)
            ->withCount('shortUrls')
            ->orderBy('name')
            ->get();
    }

    public function emailExists(string $email)
    {
        return User::where('email', $email)->exists();
    }

    public function create(array $data)
    {
        return User::create($data);
    }
}
