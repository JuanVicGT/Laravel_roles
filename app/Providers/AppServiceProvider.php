<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ruta base de los componentes
        $componentBasePath = resource_path('views/components/penguin');

        // Escanea la carpeta para encontrar todos los archivos Blade
        foreach (scandir($componentBasePath) as $file) {
            if (Str::endsWith($file, '.blade.php')) {
                $componentName = Str::before($file, '.blade.php'); // Extrae el nombre del componente
                Blade::component("components.penguin.$componentName", "penguin-$componentName");
            }
        }
    }
}
