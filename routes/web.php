<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', fn () => view('welcome'))->where('any', '.*');

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/admin-only', function () {
        return "Welcome Admin!";
    });
});
