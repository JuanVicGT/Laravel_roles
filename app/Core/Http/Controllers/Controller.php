<?php

namespace App\Http\Controllers;

// Gestión de configuraciones
use App\Services\AppSettingService;

abstract class Controller {
    public AppSettingService $appSetting;

    public function __construct() {
        $this->appSetting = app(AppSettingService::class);
    }
}
