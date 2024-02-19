<?php

namespace App\Http\Utils;

class PermissionTools
{
    /** The models who need permissions */
    public const PERMISSION_MODELS = ['user', 'role', 'permission'];

    /** The actions to realize in the models */
    public const PERMISSION_ACTIONS = ['list', 'view', 'create', 'update', 'delete'];
}
