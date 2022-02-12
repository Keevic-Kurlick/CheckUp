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

Route::group(['prefix' => 'menu'], function () {

    Route::get('/services', [App\Http\Controllers\Menu\ServicesController::class, 'servicesList'])
        ->name('menu.services.list');

    Route::middleware( 'auth')->post('/orders/create', [\App\Http\Controllers\Menu\OrdersController::class, 'store'])
        ->name('menu.orders.store');
});

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {

    Route::get('/orders', [OrdersController::class, 'ordersList'])
        ->name('profile.orders.list');

    Route::get('settings', [\App\Http\Controllers\Profile\SettingsController::class, 'settings'])
        ->name('profile.settings');

    Route::get('documents', [\App\Http\Controllers\Profile\DocumentsController::class, 'profileDocuments'])
        ->name('profile.documents');

    Route::post('documents/store', [\App\Http\Controllers\Profile\DocumentsController::class, 'store'])
        ->name('profile.documents.store');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
});
