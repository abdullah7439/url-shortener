<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_and_member_can_create_short_urls()
    {
        $company = $this->company();

        foreach ([User::ROLE_ADMIN, User::ROLE_MEMBER] as $role) {
            $user = $this->userWithRole($role, $company);

            $this->actingAs($user)
                ->post('/short-urls', ['original_url' => 'https://example.com/'.$role])
                ->assertRedirect(route('short-urls.index'));

            $this->assertDatabaseHas('short_urls', [
                'user_id' => $user->id,
                'company_id' => $company->id,
                'original_url' => 'https://example.com/'.$role,
            ]);
        }
    }

    public function test_super_admin_cannot_create_a_short_url()
    {
        $superAdmin = $this->superAdmin();

        $this->actingAs($superAdmin)->get('/short-urls/create')->assertForbidden();

        $this->actingAs($superAdmin)
            ->post('/short-urls', ['original_url' => 'https://example.com/nope'])
            ->assertForbidden();

        $this->assertDatabaseCount('short_urls', 0);
    }

    public function test_admin_only_sees_short_urls_of_their_own_company()
    {
        $companyA = $this->company('Company A');
        $companyB = $this->company('Company B');

        $adminA = $this->userWithRole(User::ROLE_ADMIN, $companyA);
        $memberA = $this->userWithRole(User::ROLE_MEMBER, $companyA);
        $adminB = $this->userWithRole(User::ROLE_ADMIN, $companyB);

        $this->shortUrlFor($adminA, 'https://example.com/a-admin');
        $this->shortUrlFor($memberA, 'https://example.com/a-member');
        $this->shortUrlFor($adminB, 'https://example.com/b-admin');

        $this->actingAs($adminA)
            ->get('/short-urls')
            ->assertOk()
            ->assertSee('https://example.com/a-admin')
            ->assertSee('https://example.com/a-member')
            ->assertDontSee('https://example.com/b-admin');
    }

    public function test_member_only_sees_short_urls_created_by_themselves()
    {
        $company = $this->company();
        $admin = $this->userWithRole(User::ROLE_ADMIN, $company);
        $member = $this->userWithRole(User::ROLE_MEMBER, $company);
        $otherMember = $this->userWithRole(User::ROLE_MEMBER, $company);

        $this->shortUrlFor($member, 'https://example.com/mine');
        $this->shortUrlFor($otherMember, 'https://example.com/theirs');
        $this->shortUrlFor($admin, 'https://example.com/admins');

        $this->actingAs($member)
            ->get('/short-urls')
            ->assertOk()
            ->assertSee('https://example.com/mine')
            ->assertDontSee('https://example.com/theirs')
            ->assertDontSee('https://example.com/admins');
    }

    public function test_short_urls_are_publicly_resolvable_and_redirect_to_the_original_url()
    {
        $member = $this->userWithRole(User::ROLE_MEMBER, $this->company());
        $shortUrl = $this->shortUrlFor($member, 'https://example.com/destination?x=1');

        $this->get('/s/'.$shortUrl->short_code)
            ->assertRedirect('https://example.com/destination?x=1');

        $this->assertGuest();
    }
}
