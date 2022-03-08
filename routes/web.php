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

Route::name('admin.')->prefix('admin')->middleware('admin')->group(function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::get('/users/roles/edit', [\App\Http\Controllers\Admin\Users\Roles\RoleController::class, 'editRolesView'])
        ->name('users.roles.edit');

    Route::post('/users/roles/edit', [\App\Http\Controllers\Admin\Users\Roles\RoleController::class, 'editRoles'])
        ->name('users.roles.edit');

    Route::get('/services', [\App\Http\Controllers\Admin\Services\ServicesController::class, 'index'])
        ->name('services');

    Route::get('/services/create', [\App\Http\Controllers\Admin\Services\ServicesController::class, 'create'])
        ->name('services.create');

    Route::post('/services/create', [\App\Http\Controllers\Admin\Services\ServicesController::class, 'store'])
        ->name('services.create');

    Route::get('/services/{id}/edit', [\App\Http\Controllers\Admin\Services\ServicesController::class, 'edit'])
        ->name('services.edit');

    Route::patch('/services/{id}/update', [\App\Http\Controllers\Admin\Services\ServicesController::class, 'update'])
        ->name('services.update');
});
