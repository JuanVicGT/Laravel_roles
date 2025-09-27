<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        $modules = collect(glob(base_path('Modules/*/module.json')))
            ->mapWithKeys(function ($path) {
                $module = json_decode(file_get_contents($path), true);
                return [$module['id'] => ['priority' => $module['priority']]];
            })
            ->sortByDesc('priority')
            ->keys();

        // Las rutas se cargan con el orden al revés, para que se procesen las rutas con mayor prioridad primero
        $this->loadCustomRoutes(array_reverse($modules->toArray()));

        foreach ($modules as $module) {
            // Cargar vistas
            $this->loadViewsFrom(base_path("Modules/{$module}/Resources/views"), 'module');

            // Cargar traducciones
            $this->loadTranslationsFrom(base_path("Modules/{$module}/Resources/lang"), 'module');

            // Cargar traducciones de Json
            $this->loadJsonTranslationsFrom(base_path("Modules/{$module}/Resources/lang"));

            // Cargar migraciones
            $this->loadMigrationsFrom(base_path("Modules/{$module}/database/migrations"));
        }
    }

    /**
     * Cargar rutas personalizadas
     *
     * A diferencia de migraciones y otros, las rutas se cargan con el orden al revés esto porque
     * al procesar la ruta, se devuelve la primera ruta que coincida con la ruta que se busca
     */
    protected function loadCustomRoutes($modules): void {
        // Cargar rutas generales
        Route::middleware('web')
            ->group(base_path('routes/general.php'));

        foreach ($modules as $module) {
            $routePath = base_path("Modules/{$module}/Routes/web.php");
            if (file_exists($routePath)) {
                Route::middleware('web')
                    ->namespace("Modules\\{$module}\\Http\\Controllers")
                    ->group($routePath);
            }
        }
    }
}
