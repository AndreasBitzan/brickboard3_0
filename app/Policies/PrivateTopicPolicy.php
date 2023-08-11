<?php

namespace App\Policies;

use App\Models\PrivateTopic;
use App\Models\User;

class PrivateTopicPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PrivateTopic $privateTopic): bool
    {
        error_log('TIS IS CHECKED');
        error_log(json_encode($privateTopic->chatters()->where('user_id', $user->id)->exists()));

        return $privateTopic->chatters()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PrivateTopic $privateTopic): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrivateTopic $privateTopic): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PrivateTopic $privateTopic): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PrivateTopic $privateTopic): bool
    {
        return false;
    }
}
