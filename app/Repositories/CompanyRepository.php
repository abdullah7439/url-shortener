<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    public function getAllWithCounts()
    {
        return Company::withCount(['users', 'shortUrls'])
            ->latest('id')
            ->get();
    }

    public function create(string $name, string $email)
    {
        return Company::create(['name' => $name, 'email' => $email]);
    }
}
