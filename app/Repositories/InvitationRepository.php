<?php

namespace App\Repositories;

use App\Models\Invitation;

class InvitationRepository
{
    public function getPendingByCompany(int $companyId)
    {
        return Invitation::where('company_id', $companyId)
            ->whereNull('accepted_at')
            ->latest('id')
            ->get();
    }

    public function findPendingByTokenOrFail(string $token)
    {
        return Invitation::with('company')
            ->where('token', $token)
            ->whereNull('accepted_at')
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return Invitation::create($data);
    }

    public function markAsAccepted(Invitation $invitation)
    {
        $invitation->update(['accepted_at' => now()]);
    }
}
