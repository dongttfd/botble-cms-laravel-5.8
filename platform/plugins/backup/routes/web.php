<?php

Route::group(['namespace' => 'Botble\Backup\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'system/backups'], function () {
            Route::get('', [
                'as'   => 'backups.list',
                'uses' => 'BackupController@getIndex',
            ]);

            Route::post('create', [
                'as'         => 'backups.create',
                'uses'       => 'BackupController@postCreate',
                'middleware' => 'preventDemo',
            ]);

            Route::get('delete/{folder}', [
                'as'         => 'backups.delete',
                'uses'       => 'BackupController@getDelete',
                'middleware' => 'preventDemo',
            ]);

            Route::get('restore/{folder}', [
                'as'   => 'backups.restore',
                'uses' => 'BackupController@getRestore',
            ]);

            Route::get('download-database/{folder}', [
                'as'         => 'backups.download.database',
                'uses'       => 'BackupController@getDownloadDatabase',
                'middleware' => 'preventDemo',
                'permission' => 'backups.list',
            ]);

            Route::get('download-uploads-folder/{folder}', [
                'as'         => 'backups.download.uploads.folder',
                'uses'       => 'BackupController@getDownloadUploadFolder',
                'middleware' => 'preventDemo',
                'permission' => 'backups.list',
            ]);
        });
    });
});
