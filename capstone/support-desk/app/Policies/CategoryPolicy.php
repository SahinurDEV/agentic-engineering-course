<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Admins manage categories (R12).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Renaming and archiving.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->isAdmin();
    }
}
