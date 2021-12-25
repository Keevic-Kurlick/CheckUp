<?php

use App\Http\Controllers\Profile\OrdersController;
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

Route::get('/menu/services', [App\Http\Controllers\Menu\ServicesController::class, 'servicesList'])
    ->name('menu.services.list');

Route::middleware('auth')->get('/profile/orders', [OrdersController::class, 'ordersList'])
    ->name('profile.orders.list');

Route::middleware('auth')->post('/menu/orders/create', [\App\Http\Controllers\Menu\OrdersController::class, 'store'])
    ->name('menu.orders.store');

Route::middleware('auth')->get('/profile/settings', [\App\Http\Controllers\Profile\SettingsController::class, 'settings'])
    ->name('profile.settings');

Route::middleware('auth')->get('/profile/documents', [\App\Http\Controllers\Profile\DocumentsController::class, 'profileDocuments'])
    ->name('profile.documents');

Route::middleware('auth')->post('/profile/documents/store', [\App\Http\Controllers\Profile\DocumentsController::class, 'store'])
    ->name('profile.documents.store');


