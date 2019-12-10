<?php

Route::group(['namespace' => 'Botble\Page\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'pages'], function () {
            Route::get('', [
                'as'   => 'pages.list',
                'uses' => 'PageController@getList',
            ]);

            Route::get('create', [
                'as'   => 'pages.create',
                'uses' => 'PageController@getCreate',
            ]);

            Route::post('create', [
                'as'   => 'pages.create',
                'uses' => 'PageController@postCreate',
            ]);

            Route::get('edit/{id}', [
                'as'   => 'pages.edit',
                'uses' => 'PageController@getEdit',
            ]);

            Route::post('edit/{id}', [
                'as'   => 'pages.edit',
                'uses' => 'PageController@postEdit',
            ]);

            Route::get('delete/{id}', [
                'as'   => 'pages.delete',
                'uses' => 'PageController@getDelete',
            ]);

            Route::post('delete-many', [
                'as'         => 'pages.delete.many',
                'uses'       => 'PageController@postDeleteMany',
                'permission' => 'pages.delete',
            ]);
        });
    });
});
