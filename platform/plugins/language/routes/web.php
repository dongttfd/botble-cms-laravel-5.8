<?php

Route::group(['namespace' => 'Botble\Language\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'settings/languages'], function () {
            Route::get('', [
                'as'   => 'languages.list',
                'uses' => 'LanguageController@getList',
            ]);

            Route::post('store', [
                'as'         => 'languages.store',
                'uses'       => 'LanguageController@postStore',
                'permission' => 'languages.create',
            ]);

            Route::post('edit', [
                'as'   => 'languages.edit',
                'uses' => 'LanguageController@postEdit',
            ]);

            Route::post('change-item-language', [
                'as'         => 'languages.change.item.language',
                'uses'       => 'LanguageController@postChangeItemLanguage',
                'permission' => false,
            ]);

            Route::get('delete/{id}', [
                'as'   => 'languages.delete',
                'uses' => 'LanguageController@getDelete',
            ]);

            Route::get('set-default', [
                'as'         => 'languages.set.default',
                'uses'       => 'LanguageController@getSetDefault',
                'permission' => 'languages.edit',
            ]);

            Route::get('get', [
                'as'         => 'languages.get',
                'uses'       => 'LanguageController@getLanguage',
                'permission' => 'languages.edit',
            ]);

            Route::post('edit-setting', [
                'as'         => 'languages.settings',
                'uses'       => 'LanguageController@postEditSettings',
                'permission' => 'languages.edit',
            ]);
        });

        Route::group(['prefix' => 'languages'], function () {

            Route::get('change-data-language/{locale}', [
                'as'         => 'languages.change.data.language',
                'uses'       => 'LanguageController@getChangeDataLanguage',
                'permission' => false,
            ]);
        });
    });
});
