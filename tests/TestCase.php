<?php

namespace Tests;

use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function company($name = 'Test Company')
    {
        return Company::create(['name' => $name]);
    }

    protected function userWithRole($role, $company = null)
    {
        return User::create([
            'name' => 'Test User',
            'email' => uniqid().'@test.com',
            'password' => 'password',
            'role' => $role,
            'company_id' => $company ? $company->id : null,
        ]);
    }

    protected function superAdmin()
    {
        return $this->userWithRole(User::ROLE_SUPER_ADMIN);
    }

    protected function shortUrlFor(User $user, string $url)
    {
        return ShortUrl::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'original_url' => $url,
            'short_code' => ShortUrl::generateCode(),
        ]);
    }
}
