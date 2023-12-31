<?php

namespace App\Policies;

use App\Models\ReactionType;
use App\Models\User;

class ReactionTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view reaction');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ReactionType $reactionType): bool
    {
        return $user->hasPermissionTo('view reaction');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create reaction');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ReactionType $reactionType): bool
    {
        return $user->hasPermissionTo('edit reaction');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ReactionType $reactionType): bool
    {
        return $user->hasPermissionTo('delete reaction');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ReactionType $reactionType): bool
    {
        return $user->hasPermissionTo('delete reaction');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ReactionType $reactionType): bool
    {
        return $user->hasPermissionTo('delete reaction');
    }
}
