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
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ViewTemplate', function ($app) {
            return new ViewTemplate();
        });
    }
}
