<?php

namespace Modules\Core\Policies;

use App\Models\User;

class GenericPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function GenericIndex(User $user, string $model_name): bool
    {
        return $user->is_admin || $user->hasPermissionTo($model_name, '.index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function GenericShow(User $user, string $model_name): bool
    {
        return $user->is_admin || $user->hasPermissionTo($model_name . '.show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function GenericCreate(User $user, string $model_name): bool
    {
        return $user->is_admin || $user->hasPermissionTo($model_name . '.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function GenericEdit(User $user, string $model_name): bool
    {
        return $user->is_admin || $user->hasPermissionTo($model_name . '.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function GenericDelete(User $user, string $model_name): bool
    {
        return $user->is_admin || $user->hasPermissionTo($model_name . '.delete');
    }
}
