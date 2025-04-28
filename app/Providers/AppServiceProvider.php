<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Modules\Core\Policies\GenericPolicy;

use App\Services\AppSettingService;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        GenericPolicy::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AppSettingService::class, function ($app) {
            return new AppSettingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function($view) {
            $view->with('appSettings', app(AppSettingService::class));
        });

        // Rutas personalizadas para el layout
        Blade::component('layouts.app', 'app-layout');
        Blade::component('layouts.guest', 'guest-layout');

        // Ruta base de los componentes
        $componentBasePath = resource_path('views/components/penguin');

        // Escanea la carpeta para encontrar todos los archivos Blade
        foreach (scandir($componentBasePath) as $file) {
            if (Str::endsWith($file, '.blade.php')) {
                $componentName = Str::before($file, '.blade.php'); // Extrae el nombre del componente
                Blade::component("components.penguin.$componentName", "penguin-$componentName");
            }
        }

        // Ruta base de los componentes
        $componentBasePath = resource_path('views/components/cmary');

        // Escanea la carpeta para encontrar todos los archivos Blade
        foreach (scandir($componentBasePath) as $file) {
            if (Str::endsWith($file, '.blade.php')) {
                $componentName = Str::before($file, '.blade.php'); // Extrae el nombre del componente
                Blade::component("components.cmary.$componentName", "cmary-$componentName");
            }
        }
    }
}
