<?php

use App\Http\Controllers\Public\{HomeController, SalePropertyController, RentPropertyController};
use Illuminate\Support\Facades\Route;

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

    Route::prefix('{country}/{city}')->middleware(['slugs.exists'])->group(function () {
        Route::get('/properties/sale', [SalePropertyController::class, 'index'])->name('sale.property.index');
        Route::get('/properties/rent', [RentPropertyController::class, 'index'])->name('rent.property.index');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
