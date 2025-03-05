<?php

namespace App\Services;

use App\Models\AppSetting;

class AppSettingService {
    /** @var array */
    protected $settings = [];

    public function __construct() {
        $this->loadSettings();
    }

    /**
     * The `loadSettings` function loads all the records from the `app_settings` table and stores them in the
     * `$settings` array. It does this by iterating over the records and using the `module` field as the key, and
     * the `settings` field (which is a JSON string) as the value. The value is then decoded from JSON to an array
     * and stored in the `$settings` array.
     *
     * @return void
     */
    private function loadSettings(): void {
        $appSettings = AppSetting::all() ?? [];

        foreach ($appSettings as $appSetting) {
            $this->settings[$appSetting->module] = json_decode($appSetting->settings, true);
        }
    }

    /**
     * The `get` function returns the value of a specific field in a specific module of the settings array.
     *
     * @param string module The `module` parameter in the `get` function is a string that represents the
     * module or section of the settings array where you want to retrieve the value.
     * @param string field The `field` parameter in the `get` function represents the key or field name in the
     * settings array where you want to retrieve the value. It is used to specify which setting you want to
     * retrieve from the settings array.
     * @param mixed default The `default` parameter in the `get` function is a default value that will be
     * returned if the specified field is not found in the settings array. If no default value is provided,
     * the function will return `null`.
     * @return mixed
     */
    public function get(string $module, string $field, $default = null): mixed {
        return $this->settings[$module][$field] ?? $default;
    }

    /**
     * The `set` function updates a specific field with a value in the settings array and then saves the
     * updated settings to the database.
     *
     * @param string module The `module` parameter in the `set` function is a string that represents the
     * module or section of the settings array where you want to set the value.
     * @param string field The `field` parameter in the `set` function represents the key or field name in the
     * settings array where you want to set the value. It is used to specify which setting you want to
     * update or add in the settings array.
     * @param mixed value The `value` parameter in the `set` function represents the value that you want to set
     * for a specific field in the settings array. When you call the `set` function with a field and a
     * value, it updates the settings array with the new value for that field and then saves the updated
     */
    public function set(string $module, string $field, mixed $value): void {
        $this->settings[$module][$field] = $value;

        $appSetting = AppSetting::where('module', $module)->first();

        if (empty($appSetting)) {
            AppSetting::create([
                'module' => $module,
                'settings' => json_encode($this->settings[$module])
            ]);
            return;
        }

        $appSetting->update(
            ['settings' => json_encode($this->settings[$module])]
        );
    }

    /**
     * The function `setFromArray` sets the settings of an object based on an array input and updates the
     * database with the new settings.
     *
     * @param string module The `module` parameter is a string that represents the module or section of the
     * settings that needs to be updated.
     * @param array new_settings An array containing key-value pairs of settings that need to be updated.
     * @return void
     */
    public function setFromArray(string $module, array $new_settings): void {
        $settings = [];
        foreach ($new_settings as $key => $value) {
            $settings[$key] = $value;
        }

        $this->settings[$module] = $settings;

        $appSetting = AppSetting::where('module', $module)->first();

        if (empty($appSetting)) {
            AppSetting::create([
                'module' => $module,
                'settings' => json_encode($this->settings[$module])
            ]);
            return;
        }

        $appSetting->update(
            ['settings' => json_encode($this->settings[$module])]
        );
    }
}
