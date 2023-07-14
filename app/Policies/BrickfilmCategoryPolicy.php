<?php

namespace App\Policies;

use App\Models\BrickfilmCategory;
use App\Models\User;

class BrickfilmCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BrickfilmCategory $brickfilmCategory): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create category');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BrickfilmCategory $brickfilmCategory): bool
    {
        return $user->hasPermissionTo('edit category');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BrickfilmCategory $brickfilmCategory): bool
    {
        return $user->hasPermissionTo('delete category');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BrickfilmCategory $brickfilmCategory): bool
    {
        return $user->hasPermissionTo('delete category');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BrickfilmCategory $brickfilmCategory): bool
    {
        return $user->hasPermissionTo('delete category');
    }
}
