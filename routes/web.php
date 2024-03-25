<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, FilterController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('public.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::name('filter.')->prefix('{country}/{region}/{city}')->group(function () {
        Route::get('/properties', [FilterController::class, 'index'])->name('properties.index');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
