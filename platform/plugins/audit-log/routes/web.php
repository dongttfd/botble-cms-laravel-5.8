<?php

Route::group(['namespace' => 'Botble\AuditLog\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'audit-log'], function () {
            Route::get('widgets/activities', [
                'as'         => 'audit-log.widget.activities',
                'uses'       => 'AuditLogController@getWidgetActivities',
                'permission' => 'audit-log.list',
            ]);

            Route::get('', [
                'as'   => 'audit-log.list',
                'uses' => 'AuditLogController@getList',
            ]);

            Route::get('delete/{id}', [
                'as'   => 'audit-log.delete',
                'uses' => 'AuditLogController@getDelete',
            ]);

            Route::post('delete-many', [
                'as'         => 'audit-log.delete.many',
                'uses'       => 'AuditLogController@postDeleteMany',
                'permission' => 'audit-log.delete',
            ]);
        });
    });
});
