<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'super'], function ($router) {
    $router->get('/detect-error', function ($router) {
        $controller = app(\App\Http\Controllers\Controller::class);
        $controller->detectError();
    })->name('super.detectError');
});