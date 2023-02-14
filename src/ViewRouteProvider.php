<?php

namespace Vuongdq\AdminLTETemplates;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class ViewRouteProvider extends RouteServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->mapVLAdminToolRoutes();
    }

    public function map() {
        parent::map();
        $this->mapVLAdminToolRoutes();
    }

    private function mapVLAdminToolRoutes() {
        Route::middleware('web')
            ->namespace('Vuongdq\AdminLTETemplates')
            ->group(__DIR__.'/routes/web.php');
    }
}
