<?php

Route::group(['namespace' => 'Botble\Gallery\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'galleries'], function () {
            Route::get('', [
                'as'   => 'galleries.list',
                'uses' => 'GalleryController@getList',
            ]);

            Route::get('create', [
                'as'   => 'galleries.create',
                'uses' => 'GalleryController@getCreate',
            ]);

            Route::post('create', [
                'as'   => 'galleries.create',
                'uses' => 'GalleryController@postCreate',
            ]);

            Route::get('edit/{id}', [
                'as'   => 'galleries.edit',
                'uses' => 'GalleryController@getEdit',
            ]);

            Route::post('edit/{id}', [
                'as'   => 'galleries.edit',
                'uses' => 'GalleryController@postEdit',
            ]);

            Route::get('delete/{id}', [
                'as'   => 'galleries.delete',
                'uses' => 'GalleryController@getDelete',
            ]);

            Route::post('delete-many', [
                'as'         => 'galleries.delete.many',
                'uses'       => 'GalleryController@postDeleteMany',
                'permission' => 'galleries.delete',
            ]);
        });
    });

    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::get('galleries', [
            'as'   => 'public.galleries',
            'uses' => 'PublicController@getGalleries',
        ]);

        Route::get('gallery/{slug}', [
            'as'   => 'public.gallery',
            'uses' => 'PublicController@getGallery',
        ]);
    });
});
