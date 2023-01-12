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
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function(){
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::prefix('auth')->group(function () {
        Route::match(['get', 'post'], 'change/password', [App\Http\Controllers\Auth\PasswordController::class, 'changePassword'])->name('changePassword');
        Route::match(['get', 'post'], 'update/profile', [App\Http\Controllers\Common\AccountController::class, 'updateProfile'])->name('updateProfile');
    });

    Route::name('admin.')->prefix('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AccountController::class, 'index'])->name('dashboard');
        
        Route::name('setup.')->prefix('setup')->group(function () {
            Route::match(['get', 'post'], 'app-setting', [App\Http\Controllers\Setup\SettingsController::class, 'appSetting'])->name('appSetting');
            Route::match(['get', 'post'], 'smtp-email-configaration', [App\Http\Controllers\Setup\SettingsController::class, 'emailSetup'])->name('emailSetup');
        });

        Route::name('module.')->prefix('module')->group(function () {
            Route::get('location', [App\Http\Controllers\Admin\Module\LocationController::class, 'index'])->name('location.index');
            Route::post('location/add', [App\Http\Controllers\Admin\Module\LocationController::class, 'store'])->name('location.store');
            Route::get('location/{id}/edit/{slug}', [App\Http\Controllers\Admin\Module\LocationController::class, 'edit'])->name('location.edit');
            Route::post('location/{id}/edit/{slug}', [App\Http\Controllers\Admin\Module\LocationController::class, 'update'])->name('location.update');
            Route::delete('location/{id}/delete', [App\Http\Controllers\Admin\Module\LocationController::class, 'delete'])->name('location.delete');

            // hotel
            Route::name('hotel.')->prefix('hotel')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\Module\HotelController::class, 'index'])->name('index');

                Route::get('attribute', [App\Http\Controllers\Admin\Core\AttributeController::class, 'index'])->name('attribute.index');
                Route::post('attribute/create', [App\Http\Controllers\Admin\Core\AttributeController::class, 'store'])->name('attribute.store');
                Route::get('attribute/{id}/edit', [App\Http\Controllers\Admin\Core\AttributeController::class, 'edit'])->name('attribute.edit');
                Route::post('attribute/{id}/update', [App\Http\Controllers\Admin\Core\AttributeController::class, 'update'])->name('attribute.update');
                Route::delete('attribute/{id}/delete', [App\Http\Controllers\Admin\Core\AttributeController::class, 'delete'])->name('attribute.delete');
                Route::get('attribute/{id}/termList', [App\Http\Controllers\Admin\Core\AttributeController::class, 'termList'])->name('attribute.termList');
                Route::post('attribute/term/term/create', [App\Http\Controllers\Admin\Core\AttributeController::class, 'termStore'])->name('attribute.termStore');
                Route::get('attribute/{id}/term/edit', [App\Http\Controllers\Admin\Core\AttributeController::class, 'termEdit'])->name('attribute.termEdit');
                Route::post('attribute/{id}/term/update', [App\Http\Controllers\Admin\Core\AttributeController::class, 'termUpdate'])->name('attribute.termUpdate');
                Route::delete('attribute/{id}/term/delete', [App\Http\Controllers\Admin\Core\AttributeController::class, 'termDelete'])->name('attribute.termDelete');

                Route::get('room/attribute', [App\Http\Controllers\Admin\Core\RoomAttributeController::class, 'index'])->name('roomAttribute.index');
                Route::post('room/attribute/create', [App\Http\Controllers\Admin\Core\RoomAttributeController::class, 'store'])->name('roomAttribute.store');
                Route::get('room/attribute/{id}/edit', [App\Http\Controllers\Admin\Core\RoomAttributeController::class, 'edit'])->name('roomAttribute.edit');
                Route::post('room/attribute/{id}/update', [App\Http\Controllers\Admin\Core\RoomAttributeController::class, 'update'])->name('roomAttribute.update');
                Route::delete('room/attribute/{id}/delete', [App\Http\Controllers\Admin\Core\RoomAttributeController::class, 'delete'])->name('roomAttribute.delete');
                Route::get('room/attribute/{id}/termList', [App\Http\Controllers\Admin\Core\RoomAttributeController::class, 'termList'])->name('roomAttribute.termList');
                Route::post('room/attribute/term/term/create', [App\Http\Controllers\Admin\Core\RoomAttributeController::class, 'termStore'])->name('roomAttribute.termStore');
                Route::get('room/attribute/{id}/term/edit', [App\Http\Controllers\Admin\Core\RoomAttributeController::class, 'termEdit'])->name('roomAttribute.termEdit');
                Route::post('room/attribute/{id}/term/update', [App\Http\Controllers\Admin\Core\RoomAttributeController::class, 'termUpdate'])->name('roomAttribute.termUpdate');
                Route::delete('room/attribute/{id}/term/delete', [App\Http\Controllers\Admin\Core\RoomAttributeController::class, 'termDelete'])->name('roomAttribute.termDelete');
            });

        });
    });
    
});