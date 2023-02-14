<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'super'], function ($router) {
    $router->get('/detect-error', function () {
        $controller = app(\App\Http\Controllers\Controller::class);
        $controller->detectError();
    })->name('super.detectError');

    $router->get('/scan-error', function () {
        $controller = app(\App\Http\Controllers\Controller::class);
        $controller->scanError();
    })->name('super.detectError');
});