<?php

use Botble\ACL\Http\Controllers\Auth\ForgotPasswordController;
use Botble\ACL\Http\Controllers\Auth\LoginController;
use Botble\ACL\Http\Controllers\Auth\ResetPasswordController;
use Botble\ACL\Http\Controllers\UserController;

Route::group(['namespace' => 'Botble\ACL\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir')], function () {
        Route::group(['middleware' => 'guest'], function () {

            Route::get('login', [LoginController::class, 'showLoginForm'])
                ->name('access.login');
            Route::post('login', [LoginController::class, 'login'])
                ->name('access.login');

            Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
                ->name('access.password.request');
            Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
                ->name('access.password.email');

            Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
                ->name('access.password.reset');
            Route::post('password/reset', [ResetPasswordController::class, 'reset'])
                ->name('access.password.reset.post');
        });

        Route::group(['middleware' => 'auth'], function () {
            Route::get('logout', [
                'as'         => 'access.logout',
                'uses'       => 'Auth\LoginController@logout',
                'permission' => false,
            ]);
        });
    });

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'system/users'], function () {
            Route::get('', [
                'as'   => 'users.list',
                'uses' => 'UserController@getList',
            ]);

            Route::get('delete/{id}', [
                'as'   => 'users.delete',
                'uses' => 'UserController@getDelete',
            ]);

            Route::get('create', [
                'as'   => 'users.create',
                'uses' => 'UserController@getCreate',
            ]);

            Route::post('create', [
                'as'   => 'users.create',
                'uses' => 'UserController@postCreate',
            ]);

            Route::post('delete-many', [
                'as'         => 'users.delete.many',
                'uses'       => 'UserController@postDeleteMany',
                'permission' => 'users.delete',
            ]);

            Route::post('update-profile/{id}', [
                'as'         => 'users.update-profile',
                'uses'       => 'UserController@postUpdateProfile',
                'permission' => false,
                'middleware' => 'preventDemo',
            ]);

            Route::post('modify-profile-image', [
                'as'         => 'users.profile.image',
                'uses'       => 'UserController@postAvatar',
                'permission' => false,
            ]);

            Route::post('change-password/{id}', [
                'as'         => 'users.change-password',
                'uses'       => 'UserController@postChangePassword',
                'permission' => false,
                'middleware' => 'preventDemo',
            ]);

            Route::get('profile/{id}', [
                'as'         => 'user.profile.view',
                'uses'       => 'UserController@getUserProfile',
                'permission' => false,
            ]);

            Route::get('impersonate/{id}', [
                'as'         => 'users.impersonate',
                'uses'       => 'UserController@getImpersonate',
                'permission' => 'superuser',
            ]);

            Route::get('leave-impersonation', [
                'as'         => 'users.leave_impersonation',
                'uses'       => 'UserController@leaveImpersonation',
                'permission' => false,
            ]);

            Route::get('make-super/{id}', [
                'as'         => 'users.make-super',
                'uses'       => 'UserController@makeSuper',
                'permission' => 'superuser',
            ]);

            Route::get('remove-super/{id}', [
                'as'         => 'users.remove-super',
                'uses'       => 'UserController@removeSuper',
                'permission' => 'superuser',
                'middleware' => 'preventDemo',
            ]);
        });

    });

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'system/roles'], function () {
            Route::get('', [
                'as'   => 'roles.list',
                'uses' => 'RoleController@getList',
            ]);

            Route::get('delete/{id}', [
                'as'   => 'roles.delete',
                'uses' => 'RoleController@getDelete',
            ]);

            Route::post('delete/many', [
                'as'         => 'roles.delete.many',
                'uses'       => 'RoleController@postDeleteMany',
                'permission' => 'roles.delete',
            ]);

            Route::get('edit/{id}', [
                'as'   => 'roles.edit',
                'uses' => 'RoleController@getEdit',
            ]);

            Route::post('edit/{id}', [
                'as'   => 'roles.edit',
                'uses' => 'RoleController@postEdit',
            ]);

            Route::get('create', [
                'as'   => 'roles.create',
                'uses' => 'RoleController@getCreate',
            ]);

            Route::post('create', [
                'as'   => 'roles.create',
                'uses' => 'RoleController@postCreate',
            ]);

            Route::get('duplicate/{id}', [
                'as'         => 'roles.duplicate',
                'uses'       => 'RoleController@getDuplicate',
                'permission' => 'roles.create',
            ]);

            Route::get('json', [
                'as'         => 'roles.list.json',
                'uses'       => 'RoleController@getJson',
                'permission' => 'roles.list',
            ]);

            Route::post('assign', [
                'as'         => 'roles.assign',
                'uses'       => 'RoleController@postAssignMember',
                'permission' => 'roles.edit',
            ]);
        });
    });

    Route::get('admin-language/{alias}', [UserController::class, 'getLanguage'])->name('admin.language');

    Route::get('admin-theme/{theme}', [UserController::class, 'getTheme'])->name('admin.theme');
});
