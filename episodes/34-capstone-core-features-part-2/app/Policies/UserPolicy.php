<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Admins see the user list and set roles (R12).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function updateRole(User $user, User $model): bool
    {
        return $user->isAdmin();
    }
}
