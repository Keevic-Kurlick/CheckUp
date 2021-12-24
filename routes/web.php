<?php

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

Route::get('/', function () {
    return view('layouts.menu.about');
})->name('main');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/services', [App\Http\Controllers\Menu\ServicesController::class, 'servicesList'])
    ->name('servicesList');

Route::get('/orders', [\App\Http\Controllers\Profile\OrdersController::class, 'ordersList'])
    ->name('ordersList');

Route::get('/settings', [\App\Http\Controllers\Profile\SettingsController::class, 'settings'])
    ->name('settings');

Route::get('/documents', [\App\Http\Controllers\Profile\DocumentsController::class, 'profileDocuments'])
    ->name('profileDocuments');

