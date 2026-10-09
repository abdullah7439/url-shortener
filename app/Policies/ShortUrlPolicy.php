<?php

namespace App\Policies;

use App\Models\User;

class ShortUrlPolicy
{
    // Every signed-in role can open the list of short urls.
    
    public function viewAny(User $user)
    {
        return true;
    }

    
     // Admin and Member can create short urls insted of superadmin.
     
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isMember();
    }
}
