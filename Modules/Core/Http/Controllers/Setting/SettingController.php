<?php

namespace Modules\Core\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Enums\AlertTypeEnum;

class SettingController extends Controller
{
    #region Vistas
    public function index()
    {
        $this->checkPermission('setting', 'index');

        $modules_settings = $this->getSettings();
        $modules_tabs = array_keys($modules_settings);

        return view('module::SettingIndex', compact('modules_settings', 'modules_tabs'));
    }

    public function view($id) {}

    public function edit($id) {}
    #endregion

    #region Acciones
    public function store(Request $request)
    {
        $modules_settings = $this->getSettings();

        // Recorremos los módulos y sus configuraciones
        foreach ($modules_settings as $module => $settings) {
            // Recorremos las secciones de configuraciones
            foreach ($settings as $settings_per_type) {
                // Recorremos las configuraciones
                foreach ($settings_per_type as $setting) {
                    $value = $request->get($setting['field']) ?? $setting['default'];

                    if ($setting['type'] == 'checkbox') {
                        $value = $request->has($setting['field']) ? true : false;
                    }

                    $this->setSetting($module, $setting['field'], $value);
                }
            }
        }

        $this->addAlert(':element saved successfully', ['element' => __('Settings')], AlertTypeEnum::SUCCESS);
        return redirect()->route('setting.index')->with('alerts', $this->getAlertsArray());
    }

    public function update() {}

    public function delete() {}
    #endregion

    #region Funciones
    public function getSettings()
    {
        // Se procesan los menús y submenús con sus respectivas rutas para cargarlos dinamicamente
        $return_settings = [];

        $modules_settings = collect(glob(base_path('Modules/*/settings.json')))
            ->map(function ($path) {
                $settings = json_decode(file_get_contents($path), true);
                return [
                    'priority' => $settings['priority'] ?? 0,
                    'settings' => $settings['settings'] ?? []
                ];
            })
            ->sortByDesc('priority');

        // Se recorren las configuraciones establecidas en los módulos
        foreach ($modules_settings as $module) {
            // Se recorren las secciones de configuraciones
            foreach ($module['settings'] as $section => $settings) {
                // Se recorren las configuraciones
                foreach ($settings as $setting) {
                    $field = $setting['field'];
                    $setting['value'] = $this->getSetting($section, $field, $setting['default']);

                    $type = $setting['input'] ?? $setting['type'];

                    $return_settings[$section][$type][$field] = $setting;
                }
            }
        }

        return $return_settings;
    }
    #endregion
}
