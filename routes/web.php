<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('welcome');
});

Route::get('/admin/user', function () {
    return view('welcome');
});

Route::get('/admin/maps', function () {
    return view('welcome');
});

Route::get('/admin/table', function () {
    return view('welcome');
});

Route::get('/admin/typography', function () {
    return view('welcome');
});

Route::get('/admin/icons', function () {
    return view('welcome');
});

Route::get('/admin/notifications', function () {
    return view('welcome');
});
