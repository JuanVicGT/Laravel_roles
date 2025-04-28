<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// Gestión de configuraciones
use App\Services\AppSettingService;

use Illuminate\Support\Facades\Auth;

use App\Utils\Alerts;

abstract class Controller
{
    use Alerts, AuthorizesRequests;

    private AppSettingService $appSetting;

    public function __construct()
    {
        $this->appSetting = app(AppSettingService::class);
    }

    /**
     * Return the value of a specific field in a specific module of the settings array.
     *
     * @param string $module The module or section of the settings array where you want to retrieve the value.
     * @param string $field The key or field name in the settings array where you want to retrieve the value.
     * @param mixed $default A default value that will be returned if the specified field is not found in the settings array.
     * @return mixed
     */
    protected function getSetting($module, $field, $default = null)
    {
        return $this->appSetting->get($module, $field, $default);
    }

    /**
     * Sets the value of a specific field in a specific module of the settings array and saves the updated settings to the database.
     *
     * @param string $module The module or section of the settings array where you want to set the value.
     * @param string $field The key or field name in the settings array where you want to set the value.
     * @param mixed $value The value that you want to set for a specific field in the settings array.
     * @return void
     */
    protected function setSetting($module, $field, $value)
    {
        $this->appSetting->set($module, $field, $value);
    }

    /**
     * Verifica si el usuario tiene permiso para una acción en un módulo específico.
     *
     * @param string $module El módulo a verificar (ej. 'user', 'roles', etc.).
     * @param string $action La acción a validar (ej. 'index', 'create', etc.).
     * @return mixed Retorna `true` si tiene permiso, de lo contrario muestra la vista de error 403.
     */
    public function checkPermission(string $module, string $action): mixed
    {
        /** @var \App\Models\User */
        $user = Auth::user();
        if ($user->is_admin) {
            return true;
        }

        if ($user->hasPermissionTo($module . '.' . $action)) {
            return true;
        }

        return response()->view('errors.403', [], 403);
    }
}
