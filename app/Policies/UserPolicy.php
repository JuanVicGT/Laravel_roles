<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /** @var string */
    private $modelName = 'user';

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
        return $user->admin || $user->hasPermissionTo('list_' . $this->modelName);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ?User $model): bool
    {
        return $user->admin || $user->hasPermissionTo('view_' . $this->modelName);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->admin || $user->hasPermissionTo('create_' . $this->modelName);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ?User $model): bool
    {
        return $user->admin || $user->hasPermissionTo('update_' . $this->modelName);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ?User $model): bool
    {
        return $user->admin || $user->hasPermissionTo('delete_' . $this->modelName);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ?User $model): bool
    {
        return $user->admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ?User $model): bool
    {
        return $user->admin;
    }
}
