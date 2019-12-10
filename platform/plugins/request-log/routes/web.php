<?php

Route::group(['namespace' => 'Botble\RequestLog\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'request-log'], function () {
            Route::get('widgets/request-errors', [
                'as'         => 'request-log.widget.request-errors',
                'uses'       => 'RequestLogController@getWidgetRequestErrors',
                'permission' => 'request-log.list',
            ]);

            Route::get('', [
                'as'   => 'request-log.list',
                'uses' => 'RequestLogController@getList',
            ]);

            Route::get('delete/{id}', [
                'as'   => 'request-log.delete',
                'uses' => 'RequestLogController@getDelete',
            ]);

            Route::post('delete-many', [
                'as'         => 'request-log.delete.many',
                'uses'       => 'RequestLogController@postDeleteMany',
                'permission' => 'request-log.delete',
            ]);
        });
    });
});
