<?php

use \Illuminate\Support\Facades\Route;

Route::prefix(config('callmeaf-base.api.prefix_url'))->as(config('callmeaf-base.api.prefix_route_name'))->middleware(config('callmeaf-base.api.middlewares'))->group(function() {
    Route::apiResource('variations',config('callmeaf-variation.controllers.variations'));
    Route::prefix('variations')->as('variations.')->controller(config('callmeaf-variation.controllers.variations'))->group(function() {
        Route::prefix('{variation}')->group(function() {
            Route::patch('/status','statusUpdate')->name('status_update');
            Route::patch('/restore','restore')->name('restore');
            Route::delete('/force','forceDestroy')->name('force_destroy');
            Route::patch('/image','imageUpdate')->name('image.update');
        });
        Route::get('/trashed/index','trashed')->name('trashed.index');
    });
});
