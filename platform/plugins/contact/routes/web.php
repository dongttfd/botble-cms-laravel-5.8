<?php

Route::group(['namespace' => 'Botble\Contact\Http\Controllers', 'middleware' => 'web'], function () {
    Route::post('send-contact', [
        'as'   => 'public.send.contact',
        'uses' => 'PublicController@postSendContact',
    ]);

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'contacts'], function () {
            Route::get('', [
                'as'   => 'contacts.list',
                'uses' => 'ContactController@getList',
            ]);

            Route::get('edit/{id}', [
                'as'   => 'contacts.edit',
                'uses' => 'ContactController@getEdit',
            ]);

            Route::post('edit/{id}', [
                'as'   => 'contacts.edit',
                'uses' => 'ContactController@postEdit',
            ]);

            Route::get('delete/{id}', [
                'as'   => 'contacts.delete',
                'uses' => 'ContactController@getDelete',
            ]);

            Route::post('delete-many', [
                'as'         => 'contacts.delete.many',
                'uses'       => 'ContactController@postDeleteMany',
                'permission' => 'contacts.delete',
            ]);

            Route::post('reply/{id}', [
                'as'   => 'contacts.reply',
                'uses' => 'ContactController@postReply',
            ]);
        });
    });
});
