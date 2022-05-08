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

Route::middleware('patientOrNotAuth')->prefix('menu')->group(function () {

    Route::get('/services', [\App\Http\Controllers\Menu\Services\ServicesController::class, 'servicesList'])
        ->name('menu.services.list');

    Route::get('/services/{id}', [\App\Http\Controllers\Menu\Services\ServicesController::class, 'show'])
        ->name('menu.services.show');

    Route::middleware( 'patient')->post('/services/{id}/order/create', [App\Http\Controllers\Menu\OrderServices\OrderServicesController::class, 'store'])
        ->name('menu.services.order.create');
});

Route::middleware(['auth'])->prefix('profile')->group(function () {

    Route::middleware('patient')->get('/orders', [App\Http\Controllers\Profile\OrdersController::class, 'ordersList'])
        ->name('profile.orders.list');

    Route::get('settings', [\App\Http\Controllers\Profile\SettingsController::class, 'settings'])
        ->name('profile.settings');

    Route::middleware('patient')->get('documents', [\App\Http\Controllers\Profile\DocumentsController::class, 'profileDocuments'])
        ->name('profile.documents');

    Route::middleware('patient')->post('documents/store', [\App\Http\Controllers\Profile\DocumentsController::class, 'store'])
        ->name('profile.documents.store');
});

Route::middleware('doctor')->group(function () {
    Route::get('orders', [\App\Http\Controllers\Orders\OrdersController::class, 'index'])
        ->name('orders.index');

    Route::get('orders/{orderId}', [\App\Http\Controllers\Orders\OrdersController::class, 'show'])
        ->name('orders.show');

    Route::post('orders/{orderId}/next-step', [\App\Http\Controllers\Orders\OrdersController::class, 'nextStep'])
        ->name('orders.next-step');

    Route::post('orders/{orderId}/cancel', [\App\Http\Controllers\Orders\OrdersController::class, 'cancel'])
        ->name('orders.cancel');

    Route::post('orders/{orderId}/complete', [\App\Http\Controllers\Orders\OrdersController::class, 'complete'])
        ->name('orders.complete');

    Route::get(
        'orders/{orderId}/downloadPassportScan',
        [\App\Http\Controllers\Orders\OrdersController::class, 'downloadPassportScan']
    )->name('orders.downloadPassportScan');

    Route::get(
        'orders/{orderId}/downloadAnalysisScan',
        [\App\Http\Controllers\Orders\OrdersController::class, 'downloadAnalysisScan']
    )->name('orders.downloadAnalysisScan');

});

Route::name('admin.')->prefix('admin')->middleware('admin')->group(function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('index');

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

    Route::delete('/services/{id}/destroy', [\App\Http\Controllers\Admin\Services\ServicesController::class, 'destroy'])
        ->name('services.destroy');

    Route::name('medical_certificates.')->prefix('medical_certificates')->group(function() {
        Route::get('/', [\App\Http\Controllers\Admin\MedicalCertificates\MedicalCertificatesController::class, 'index'])
            ->name('index');

        Route::get('/create', [\App\Http\Controllers\Admin\MedicalCertificates\MedicalCertificatesController::class, 'create'])
            ->name('create');

        Route::post('/create', [\App\Http\Controllers\Admin\MedicalCertificates\MedicalCertificatesController::class, 'store'])
            ->name('store');

        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\MedicalCertificates\MedicalCertificatesController::class,'edit'])
            ->name('edit');

        Route::patch('/{id}/update', [\App\Http\Controllers\Admin\MedicalCertificates\MedicalCertificatesController::class, 'update'])
            ->name('update');

        Route::delete('/{id}/destroy', [\App\Http\Controllers\Admin\MedicalCertificates\MedicalCertificatesController::class, 'destroy'])
            ->name('destroy');
    });
});
