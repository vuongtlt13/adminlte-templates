<?php

namespace Vuongdq\AdminLTETemplates;

use Illuminate\Support\ServiceProvider;

class AdminLTETemplatesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'adminlte-templates');

        $this->app->register(ViewRouteProvider::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ViewProcessor', function ($app) {
            return new ViewProcessor();
        });

    }
}
