<?php

Route::group(['namespace' => 'Botble\Menu\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'menus'], function () {
            Route::get('', [
                'as'   => 'menus.list',
                'uses' => 'MenuController@getList',
            ]);

            Route::get('create', [
                'as'   => 'menus.create',
                'uses' => 'MenuController@getCreate',
            ]);

            Route::post('create', [
                'as'   => 'menus.create',
                'uses' => 'MenuController@postCreate',
            ]);

            Route::get('edit/{id}', [
                'as'   => 'menus.edit',
                'uses' => 'MenuController@getEdit',
            ]);

            Route::post('edit/{id}', [
                'as'   => 'menus.edit',
                'uses' => 'MenuController@postEdit',
            ]);

            Route::get('delete/{id}', [
                'as'   => 'menus.delete',
                'uses' => 'MenuController@getDelete',
            ]);

            Route::post('delete-many', [
                'as'         => 'menus.delete.many',
                'uses'       => 'MenuController@postDeleteMany',
                'permission' => 'menus.delete',
            ]);
        });
    });
});
