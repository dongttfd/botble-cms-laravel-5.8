<?php

use Botble\ACL\Http\Controllers\ApiController;

Route::group([
    'prefix'     => 'api/v1/users',
    'middleware' => ['api'],
], function () {

    Route::post('login', [ApiController::class, 'login'])->name('api.login');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('logout', [ApiController::class, 'logout'])->name('api.logout');
        Route::post('update-profile', [ApiController::class, 'updateProfile'])->name('api.update-profile');
        Route::post('change-password', [ApiController::class, 'updatePassword'])->name('api.change-password');
    });

});