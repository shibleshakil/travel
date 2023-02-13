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
                Route::get('/', [App\Http\Controllers\Admin\Module\Hotel\HotelController::class, 'index'])->name('index');
                Route::get('/search/{name}', [App\Http\Controllers\Admin\Module\Hotel\HotelController::class, 'search'])->name('search');
                Route::get('/create', [App\Http\Controllers\Admin\Module\Hotel\HotelController::class, 'create'])->name('create');
                Route::post('/create', [App\Http\Controllers\Admin\Module\Hotel\HotelController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [App\Http\Controllers\Admin\Module\Hotel\HotelController::class, 'edit'])->name('edit');
                Route::post('/edit/{id}', [App\Http\Controllers\Admin\Module\Hotel\HotelController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [App\Http\Controllers\Admin\Module\Hotel\HotelController::class, 'delete'])->name('delete');
                Route::get('/recovery', [App\Http\Controllers\Admin\Module\Hotel\HotelController::class, 'recovery'])->name('recovery');
                Route::get('recovery/search/{name}', [App\Http\Controllers\Admin\Module\Hotel\HotelController::class, 'recoverySearch'])->name('recoverySearch');
                Route::put('/restore/{id}', [App\Http\Controllers\Admin\Module\Hotel\HotelController::class, 'restore'])->name('restore');

                // hotel Room
                Route::name('room.')->prefix('room')->group(function () {
                    Route::get('/{id}', [App\Http\Controllers\Admin\Module\Hotel\HotelRoomController::class, 'index'])->name('index');
                    Route::post('create/{hotel}', [App\Http\Controllers\Admin\Module\Hotel\HotelRoomController::class, 'store'])->name('store');
                    Route::get('/{hotel}/edit/{id}', [App\Http\Controllers\Admin\Module\Hotel\HotelRoomController::class, 'edit'])->name('edit');
                    Route::post('/{hotel}/edit/{id}', [App\Http\Controllers\Admin\Module\Hotel\HotelRoomController::class, 'update'])->name('update');
                    Route::delete('/delete/{id}', [App\Http\Controllers\Admin\Module\Hotel\HotelRoomController::class, 'delete'])->name('delete');
                });


                Route::name('attribute.')->prefix('attribute')->group(function () {
                    Route::get('/', [App\Http\Controllers\Admin\Module\Hotel\Core\AttributeController::class, 'index'])->name('index');
                    Route::post('/create', [App\Http\Controllers\Admin\Module\Hotel\Core\AttributeController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [App\Http\Controllers\Admin\Module\Hotel\Core\AttributeController::class, 'edit'])->name('edit');
                    Route::post('/{id}/update', [App\Http\Controllers\Admin\Module\Hotel\Core\AttributeController::class, 'update'])->name('update');
                    Route::delete('/{id}/delete', [App\Http\Controllers\Admin\Module\Hotel\Core\AttributeController::class, 'delete'])->name('delete');
                    Route::get('/{id}/termList', [App\Http\Controllers\Admin\Module\Hotel\Core\AttributeController::class, 'termList'])->name('termList');
                    Route::post('/term/term/create', [App\Http\Controllers\Admin\Module\Hotel\Core\AttributeController::class, 'termStore'])->name('termStore');
                    Route::get('/{id}/term/edit', [App\Http\Controllers\Admin\Module\Hotel\Core\AttributeController::class, 'termEdit'])->name('termEdit');
                    Route::post('/{id}/term/update', [App\Http\Controllers\Admin\Module\Hotel\Core\AttributeController::class, 'termUpdate'])->name('termUpdate');
                    Route::delete('/{id}/term/delete', [App\Http\Controllers\Admin\Module\Hotel\Core\AttributeController::class, 'termDelete'])->name('termDelete');
                });

                Route::name('roomAttribute.')->prefix('roomAttribute')->group(function () {
                    Route::get('/', [App\Http\Controllers\Admin\Module\Hotel\Core\RoomAttributeController::class, 'index'])->name('index');
                    Route::post('create', [App\Http\Controllers\Admin\Module\Hotel\Core\RoomAttributeController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [App\Http\Controllers\Admin\Module\Hotel\Core\RoomAttributeController::class, 'edit'])->name('edit');
                    Route::post('/{id}/update', [App\Http\Controllers\Admin\Module\Hotel\Core\RoomAttributeController::class, 'update'])->name('update');
                    Route::delete('/{id}/delete', [App\Http\Controllers\Admin\Module\Hotel\Core\RoomAttributeController::class, 'delete'])->name('delete');
                    Route::get('/{id}/termList', [App\Http\Controllers\Admin\Module\Hotel\Core\RoomAttributeController::class, 'termList'])->name('termList');
                    Route::post('term/term/create', [App\Http\Controllers\Admin\Module\Hotel\Core\RoomAttributeController::class, 'termStore'])->name('termStore');
                    Route::get('/{id}/term/edit', [App\Http\Controllers\Admin\Module\Hotel\Core\RoomAttributeController::class, 'termEdit'])->name('termEdit');
                    Route::post('/{id}/term/update', [App\Http\Controllers\Admin\Module\Hotel\Core\RoomAttributeController::class, 'termUpdate'])->name('termUpdate');
                    Route::delete('/{id}/term/delete', [App\Http\Controllers\Admin\Module\Hotel\Core\RoomAttributeController::class, 'termDelete'])->name('termDelete');
                });
            });

            // boat
            Route::name('boat.')->prefix('boat')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\Module\Boat\BoatController::class, 'index'])->name('index');
                Route::get('/search/{name}', [App\Http\Controllers\Admin\Module\Boat\BoatController::class, 'search'])->name('search');
                Route::get('/create', [App\Http\Controllers\Admin\Module\Boat\BoatController::class, 'create'])->name('create');
                Route::post('/create', [App\Http\Controllers\Admin\Module\Boat\BoatController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [App\Http\Controllers\Admin\Module\Boat\BoatController::class, 'edit'])->name('edit');
                Route::post('/edit/{id}', [App\Http\Controllers\Admin\Module\Boat\BoatController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [App\Http\Controllers\Admin\Module\Boat\BoatController::class, 'delete'])->name('delete');
                Route::get('/recovery', [App\Http\Controllers\Admin\Module\Boat\BoatController::class, 'recovery'])->name('recovery');
                Route::get('recovery/search/{name}', [App\Http\Controllers\Admin\Module\Boat\BoatController::class, 'recoverySearch'])->name('recoverySearch');
                Route::put('/restore/{id}', [App\Http\Controllers\Admin\Module\Boat\BoatController::class, 'restore'])->name('restore');

                Route::name('attribute.')->prefix('attribute')->group(function () {
                    Route::get('/', [App\Http\Controllers\Admin\Module\Boat\AttributeController::class, 'index'])->name('index');
                    Route::post('/create', [App\Http\Controllers\Admin\Module\Boat\AttributeController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [App\Http\Controllers\Admin\Module\Boat\AttributeController::class, 'edit'])->name('edit');
                    Route::post('/{id}/update', [App\Http\Controllers\Admin\Module\Boat\AttributeController::class, 'update'])->name('update');
                    Route::delete('/{id}/delete', [App\Http\Controllers\Admin\Module\Boat\AttributeController::class, 'delete'])->name('delete');
                    Route::get('/{id}/termList', [App\Http\Controllers\Admin\Module\Boat\AttributeController::class, 'termList'])->name('termList');
                    Route::post('/term/term/create', [App\Http\Controllers\Admin\Module\Boat\AttributeController::class, 'termStore'])->name('termStore');
                    Route::get('/{id}/term/edit', [App\Http\Controllers\Admin\Module\Boat\AttributeController::class, 'termEdit'])->name('termEdit');
                    Route::post('/{id}/term/update', [App\Http\Controllers\Admin\Module\Boat\AttributeController::class, 'termUpdate'])->name('termUpdate');
                    Route::delete('/{id}/term/delete', [App\Http\Controllers\Admin\Module\Boat\AttributeController::class, 'termDelete'])->name('termDelete');
                });
            });

            // car
            Route::name('car.')->prefix('car')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\Module\Car\CarController::class, 'index'])->name('index');
                Route::get('/search/{name}', [App\Http\Controllers\Admin\Module\Car\CarController::class, 'search'])->name('search');
                Route::get('/create', [App\Http\Controllers\Admin\Module\Car\CarController::class, 'create'])->name('create');
                Route::post('/create', [App\Http\Controllers\Admin\Module\Car\CarController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [App\Http\Controllers\Admin\Module\Car\CarController::class, 'edit'])->name('edit');
                Route::post('/edit/{id}', [App\Http\Controllers\Admin\Module\Car\CarController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [App\Http\Controllers\Admin\Module\Car\CarController::class, 'delete'])->name('delete');
                Route::get('/recovery', [App\Http\Controllers\Admin\Module\Car\CarController::class, 'recovery'])->name('recovery');
                Route::get('recovery/search/{name}', [App\Http\Controllers\Admin\Module\Car\CarController::class, 'recoverySearch'])->name('recoverySearch');
                Route::put('/restore/{id}', [App\Http\Controllers\Admin\Module\Car\CarController::class, 'restore'])->name('restore');

                Route::name('attribute.')->prefix('attribute')->group(function () {
                    Route::get('/', [App\Http\Controllers\Admin\Module\Car\AttributeController::class, 'index'])->name('index');
                    Route::post('/create', [App\Http\Controllers\Admin\Module\Car\AttributeController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [App\Http\Controllers\Admin\Module\Car\AttributeController::class, 'edit'])->name('edit');
                    Route::post('/{id}/update', [App\Http\Controllers\Admin\Module\Car\AttributeController::class, 'update'])->name('update');
                    Route::delete('/{id}/delete', [App\Http\Controllers\Admin\Module\Car\AttributeController::class, 'delete'])->name('delete');
                    Route::get('/{id}/termList', [App\Http\Controllers\Admin\Module\Car\AttributeController::class, 'termList'])->name('termList');
                    Route::post('/term/term/create', [App\Http\Controllers\Admin\Module\Car\AttributeController::class, 'termStore'])->name('termStore');
                    Route::get('/{id}/term/edit', [App\Http\Controllers\Admin\Module\Car\AttributeController::class, 'termEdit'])->name('termEdit');
                    Route::post('/{id}/term/update', [App\Http\Controllers\Admin\Module\Car\AttributeController::class, 'termUpdate'])->name('termUpdate');
                    Route::delete('/{id}/term/delete', [App\Http\Controllers\Admin\Module\Car\AttributeController::class, 'termDelete'])->name('termDelete');
                });
            });

            // space
            Route::name('space.')->prefix('space')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\Module\Space\SpaceController::class, 'index'])->name('index');
                Route::get('/search/{name}', [App\Http\Controllers\Admin\Module\Space\SpaceController::class, 'search'])->name('search');
                Route::get('/create', [App\Http\Controllers\Admin\Module\Space\SpaceController::class, 'create'])->name('create');
                Route::post('/create', [App\Http\Controllers\Admin\Module\Space\SpaceController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [App\Http\Controllers\Admin\Module\Space\SpaceController::class, 'edit'])->name('edit');
                Route::post('/edit/{id}', [App\Http\Controllers\Admin\Module\Space\SpaceController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [App\Http\Controllers\Admin\Module\Space\SpaceController::class, 'delete'])->name('delete');
                Route::get('/recovery', [App\Http\Controllers\Admin\Module\Space\SpaceController::class, 'recovery'])->name('recovery');
                Route::get('recovery/search/{name}', [App\Http\Controllers\Admin\Module\Space\SpaceController::class, 'recoverySearch'])->name('recoverySearch');
                Route::put('/restore/{id}', [App\Http\Controllers\Admin\Module\Space\SpaceController::class, 'restore'])->name('restore');

                Route::name('attribute.')->prefix('attribute')->group(function () {
                    Route::get('/', [App\Http\Controllers\Admin\Module\Space\AttributeController::class, 'index'])->name('index');
                    Route::post('/create', [App\Http\Controllers\Admin\Module\Space\AttributeController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [App\Http\Controllers\Admin\Module\Space\AttributeController::class, 'edit'])->name('edit');
                    Route::post('/{id}/update', [App\Http\Controllers\Admin\Module\Space\AttributeController::class, 'update'])->name('update');
                    Route::delete('/{id}/delete', [App\Http\Controllers\Admin\Module\Space\AttributeController::class, 'delete'])->name('delete');
                    Route::get('/{id}/termList', [App\Http\Controllers\Admin\Module\Space\AttributeController::class, 'termList'])->name('termList');
                    Route::post('/term/term/create', [App\Http\Controllers\Admin\Module\Space\AttributeController::class, 'termStore'])->name('termStore');
                    Route::get('/{id}/term/edit', [App\Http\Controllers\Admin\Module\Space\AttributeController::class, 'termEdit'])->name('termEdit');
                    Route::post('/{id}/term/update', [App\Http\Controllers\Admin\Module\Space\AttributeController::class, 'termUpdate'])->name('termUpdate');
                    Route::delete('/{id}/term/delete', [App\Http\Controllers\Admin\Module\Space\AttributeController::class, 'termDelete'])->name('termDelete');
                });
            });

            // flight
            Route::name('flight.')->prefix('flight')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\Module\Flight\FlightController::class, 'index'])->name('index');
                Route::get('/search/{name}', [App\Http\Controllers\Admin\Module\Flight\FlightController::class, 'search'])->name('search');
                Route::get('/create', [App\Http\Controllers\Admin\Module\Flight\FlightController::class, 'create'])->name('create');
                Route::post('/create', [App\Http\Controllers\Admin\Module\Flight\FlightController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [App\Http\Controllers\Admin\Module\Flight\FlightController::class, 'edit'])->name('edit');
                Route::post('/edit/{id}', [App\Http\Controllers\Admin\Module\Flight\FlightController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [App\Http\Controllers\Admin\Module\Flight\FlightController::class, 'delete'])->name('delete');
                Route::get('/recovery', [App\Http\Controllers\Admin\Module\Flight\FlightController::class, 'recovery'])->name('recovery');
                Route::get('recovery/search/{name}', [App\Http\Controllers\Admin\Module\Flight\FlightController::class, 'recoverySearch'])->name('recoverySearch');
                Route::put('/restore/{id}', [App\Http\Controllers\Admin\Module\Flight\FlightController::class, 'restore'])->name('restore');

                Route::name('airline.')->prefix('airline')->group(function () {
                    Route::get('/', [App\Http\Controllers\Admin\Module\Flight\AirlineController::class, 'index'])->name('index');
                    Route::post('/create', [App\Http\Controllers\Admin\Module\Flight\AirlineController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [App\Http\Controllers\Admin\Module\Flight\AirlineController::class, 'edit'])->name('edit');
                    Route::post('/{id}/update', [App\Http\Controllers\Admin\Module\Flight\AirlineController::class, 'update'])->name('update');
                    Route::delete('/{id}/delete', [App\Http\Controllers\Admin\Module\Flight\AirlineController::class, 'delete'])->name('delete');
                });

                Route::name('airport.')->prefix('airport')->group(function () {
                    Route::get('/', [App\Http\Controllers\Admin\Module\Flight\AirportController::class, 'index'])->name('index');
                    Route::post('/create', [App\Http\Controllers\Admin\Module\Flight\AirportController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [App\Http\Controllers\Admin\Module\Flight\AirportController::class, 'edit'])->name('edit');
                    Route::post('/{id}/update', [App\Http\Controllers\Admin\Module\Flight\AirportController::class, 'update'])->name('update');
                    Route::delete('/{id}/delete', [App\Http\Controllers\Admin\Module\Flight\AirportController::class, 'delete'])->name('delete');
                });

                Route::name('attribute.')->prefix('attribute')->group(function () {
                    Route::get('/', [App\Http\Controllers\Admin\Module\Flight\AttributeController::class, 'index'])->name('index');
                    Route::post('/create', [App\Http\Controllers\Admin\Module\Flight\AttributeController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [App\Http\Controllers\Admin\Module\Flight\AttributeController::class, 'edit'])->name('edit');
                    Route::post('/{id}/update', [App\Http\Controllers\Admin\Module\Flight\AttributeController::class, 'update'])->name('update');
                    Route::delete('/{id}/delete', [App\Http\Controllers\Admin\Module\Flight\AttributeController::class, 'delete'])->name('delete');
                    Route::get('/{id}/termList', [App\Http\Controllers\Admin\Module\Flight\AttributeController::class, 'termList'])->name('termList');
                    Route::post('/term/term/create', [App\Http\Controllers\Admin\Module\Flight\AttributeController::class, 'termStore'])->name('termStore');
                    Route::get('/{id}/term/edit', [App\Http\Controllers\Admin\Module\Flight\AttributeController::class, 'termEdit'])->name('termEdit');
                    Route::post('/{id}/term/update', [App\Http\Controllers\Admin\Module\Flight\AttributeController::class, 'termUpdate'])->name('termUpdate');
                    Route::delete('/{id}/term/delete', [App\Http\Controllers\Admin\Module\Flight\AttributeController::class, 'termDelete'])->name('termDelete');
                });
            });

        });
    });
    
});