<?php

namespace App\Policies;

use App\Models\User;
use Pktharindu\NovaPermissions\Role;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view roles');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $pktharinduNovaPermissionsRole): bool
    {
        return $user->hasPermissionTo('view roles');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create roles');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $pktharinduNovaPermissionsRole): bool
    {
        return $user->hasPermissionTo('edit roles');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $pktharinduNovaPermissionsRole): bool
    {
        return $user->hasPermissionTo('delete roles');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $pktharinduNovaPermissionsRole): bool
    {
        return $user->hasPermissionTo('edit roles');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $pktharinduNovaPermissionsRole): bool
    {
        return $user->hasPermissionTo('delete roles');
    }
}
