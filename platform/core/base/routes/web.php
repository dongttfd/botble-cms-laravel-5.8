<?php

Route::group(['namespace' => 'Botble\Base\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'system/info'], function () {
            Route::get('', [
                'as'         => 'system.info',
                'uses'       => 'SystemController@getInfo',
                'permission' => 'superuser',
            ]);
        });

        Route::group(['prefix' => 'system/cache'], function () {

            Route::get('', [
                'as'         => 'system.cache',
                'uses'       => 'SystemController@getCacheManagement',
                'permission' => 'superuser',
            ]);

            Route::post('clear', [
                'as'         => 'system.cache.clear',
                'uses'       => 'SystemController@postClearCache',
                'permission' => 'superuser',
            ]);
        });

        Route::group(['prefix' => 'plugins'], function () {
            Route::get('', [
                'as'   => 'plugins.list',
                'uses' => 'SystemController@getListPlugins',
            ]);

            Route::get('change', [
                'as'         => 'plugins.change.status',
                'uses'       => 'SystemController@getChangePluginStatus',
                'middleware' => 'preventDemo',
                'permission' => 'plugins.list',
            ]);

            Route::post('remove', [
                'as'         => 'plugins.remove',
                'uses'       => 'SystemController@postRemovePlugin',
                'middleware' => 'preventDemo',
                'permission' => 'plugins.list',
            ]);
        });
    });

    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
            Route::get('', [
                'as'   => 'public.index',
                'uses' => 'PublicController@getIndex',
            ]);

            Route::get('sitemap.xml', [
                'as'   => 'public.sitemap',
                'uses' => 'PublicController@getSiteMap',
            ]);

            Route::get('feed/json', [
                'as'   => 'public.feed.json',
                'uses' => 'PublicController@getJsonFeed',
            ]);

            Route::get('{slug}' . config('core.base.general.public_single_ending_url'), [
                'as'   => 'public.single',
                'uses' => 'PublicController@getView',
            ]);
        });
    }
});
