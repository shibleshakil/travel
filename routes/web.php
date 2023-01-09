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
    });
    
});