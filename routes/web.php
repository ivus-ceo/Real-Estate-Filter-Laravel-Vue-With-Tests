<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    $cities = \App\Models\City::get();
    $districts = \App\Models\District::get();
    $buildings = \App\Models\Building::get();
    $rooms = \App\Models\Room::get();
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//    ]);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
