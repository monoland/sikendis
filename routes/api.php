<?php

Route::middleware('throttle:200,1')->group(function () {
    Route::get('company', 'Mono\WebController@company');
});

Route::middleware(['auth:api', 'throttle:5000,1'])->group(function () {
    Route::post('document', 'Mono\DocumentController@store')->name('document.store');
    Route::post('media', 'Mono\MediaController@store')->name('media.store');
});

Route::middleware(['api', 'auth:api'])->group(function () {
    // monoland
    Route::get('user', 'Mono\WebController@user')->name('user.info');
    Route::get('menus', 'Mono\WebController@menus')->name('user.menu');
    Route::put('profile', 'Mono\WebController@profile')->name('user.profile');
    Route::put('password', 'Mono\WebController@password')->name('change.password');
    Route::get('authent/combo', 'Mono\AuthentController@combo');
    Route::post('users/bulkdelete', 'Mono\UserController@bulkdelete');

    Route::resource('users', 'Mono\UserController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('setting', 'Mono\SettingController')->only(['index', 'store', 'update', 'show', 'destroy']);
    Route::resource('client', 'Mono\ClientController')->only(['index', 'store', 'update', 'destroy']);
    Route::post('document/bulkdelete', 'Mono\DocumentController@bulkdelete');
    Route::resource('document', 'Mono\DocumentController')->only(['index', 'update', 'destroy']);

    // application
    Route::resource('agency', 'Apps\AgencyController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('agency.user', 'Apps\AgencyUserController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('segment', 'Apps\SegmentController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('segment.item', 'Apps\ItemController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('brand', 'Apps\BrandController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('brand.type', 'Apps\TypeController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('type.vehicle', 'Apps\TypeVehicleController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('garage', 'Apps\GarageController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('garage.user', 'Apps\GarageUserController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('vehicle', 'Apps\VehicleController')->only(['index', 'store', 'update', 'destroy']);
    Route::post('service/{service}/submission', 'Apps\ServiceController@submission');
    Route::post('service/{service}/examine', 'Apps\ServiceController@examine');
    Route::post('service/{service}/approval', 'Apps\ServiceController@approval');
    Route::post('service/{service}/workorder', 'Apps\ServiceController@workorder');
    Route::resource('service', 'Apps\ServiceController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('service.invoice', 'Apps\InvoiceController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('notification', 'Apps\NotificationController')->only(['index']);
});
