<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});


/*
|--------------------------------------------------------------------------
| Original Helper Demo
|--------------------------------------------------------------------------
*/

Route::get(
    '/call-helper',
    [DashboardController::class, 'callHelper']
);


/*
|--------------------------------------------------------------------------
| Helper Dashboard
|--------------------------------------------------------------------------
*/

Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)->name('dashboard');

