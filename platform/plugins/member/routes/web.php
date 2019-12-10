<?php

Route::group([
    'namespace'  => 'Botble\Member\Http\Controllers',
    'prefix'     => config('core.base.general.admin_dir'),
    'middleware' => ['web', 'auth'],
], function () {
    Route::group(['prefix' => 'members'], function () {
        Route::get('', [
            'as'   => 'member.list',
            'uses' => 'MemberController@getList',
        ]);

        Route::get('create', [
            'as'   => 'member.create',
            'uses' => 'MemberController@getCreate',
        ]);

        Route::post('create', [
            'as'   => 'member.create',
            'uses' => 'MemberController@postCreate',
        ]);

        Route::get('edit/{id}', [
            'as'   => 'member.edit',
            'uses' => 'MemberController@getEdit',
        ]);

        Route::post('edit/{id}', [
            'as'   => 'member.edit',
            'uses' => 'MemberController@postEdit',
        ]);

        Route::get('delete/{id}', [
            'as'   => 'member.delete',
            'uses' => 'MemberController@getDelete',
        ]);

        Route::post('delete-many', [
            'as'         => 'member.delete.many',
            'uses'       => 'MemberController@postDeleteMany',
            'permission' => 'member.delete',
        ]);
    });
});

if (defined('THEME_MODULE_SCREEN_NAME')) {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        Route::group([
            'namespace'  => 'Botble\Member\Http\Controllers',
            'middleware' => ['web'],
            'as'         => 'public.member.',
        ], function () {

            Route::group(['middleware' => ['member.guest']], function () {
                Route::get('login', 'LoginController@showLoginForm')->name('login');
                Route::post('login', 'LoginController@login')->name('login.post');

                Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
                Route::post('register', 'RegisterController@register')->name('register.post');

                Route::get('verify', 'RegisterController@getVerify')->name('verify');

                Route::get('password/request',
                    'ForgotPasswordController@showLinkRequestForm')->name('password.request');
                Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
                Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
                Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
            });

            Route::group([
                'middleware' => [config('plugins.member.general.verify_email') ? 'member.guest' : 'member'],
            ], function () {
                Route::get('register/confirm/resend',
                    'RegisterController@resendConfirmation')->name('resend_confirmation');
                Route::get('register/confirm/{email}', 'RegisterController@confirm')->name('confirm');
            });
        });

        Route::group([
            'namespace'  => 'Botble\Member\Http\Controllers',
            'middleware' => ['web', 'member'],
            'as'         => 'public.member.',
        ], function () {
            Route::group([
                'prefix' => 'account',
            ], function () {

                Route::post('logout', 'LoginController@logout')->name('logout');

                Route::get('dashboard', [
                    'as'   => 'dashboard',
                    'uses' => 'PublicController@getDashboard',
                ]);

                Route::get('settings', [
                    'as'   => 'settings',
                    'uses' => 'PublicController@getSettings',
                ]);

                Route::post('settings', [
                    'as'   => 'post.settings',
                    'uses' => 'PublicController@postSettings',
                ]);

                Route::get('security', [
                    'as'   => 'security',
                    'uses' => 'PublicController@getSecurity',
                ]);

                Route::put('security', [
                    'as'   => 'post.security',
                    'uses' => 'PublicController@postSecurity',
                ]);

                Route::post('avatar', [
                    'as'   => 'avatar',
                    'uses' => 'PublicController@postAvatar',
                ]);

            });

            Route::group(['prefix' => 'ajax/members'], function () {
                Route::get('activity-logs', [
                    'as'   => 'activity-logs',
                    'uses' => 'PublicController@getActivityLogs',
                ]);

                Route::post('upload', [
                    'as'   => 'upload',
                    'uses' => 'PublicController@postUpload',
                ]);
            });
        });

    });
}
