<?php

if (defined('THEME_MODULE_SCREEN_NAME')) {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        Route::group([
            'namespace'  => 'Botble\Blog\Http\Controllers',
            'middleware' => ['web', 'member'],
            'as'         => 'public.member.',
        ], function () {
            Route::group([
                'prefix' => 'account/posts',
            ], function () {

                Route::get('', [
                    'as'   => 'posts.list',
                    'uses' => 'MemberPostController@getList',
                ]);

                Route::get('create', [
                    'as'   => 'posts.create',
                    'uses' => 'MemberPostController@getCreate',
                ]);

                Route::post('create', [
                    'as'   => 'posts.create',
                    'uses' => 'MemberPostController@postCreate',
                ]);

                Route::get('edit/{id}', [
                    'as'   => 'posts.edit',
                    'uses' => 'MemberPostController@getEdit',
                ]);

                Route::post('edit/{id}', [
                    'as'   => 'posts.edit',
                    'uses' => 'MemberPostController@postEdit',
                ]);

            });

            Route::group(['prefix' => 'ajax/members'], function () {
                Route::get('delete/{id}', [
                    'as'   => 'posts.delete',
                    'uses' => 'MemberPostController@delete',
                ]);
            });
        });

    });
}