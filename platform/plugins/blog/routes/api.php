<?php

Route::group([
    'middleware' => 'api',
    'prefix'     => 'api/v1',
    'namespace'  => 'Botble\Blog\Http\Controllers\API',
], function () {

    Route::get('search', 'PostController@getSearch')->name('public.api.search');
    Route::get('posts', 'PostController@getList');
    Route::get('categories', 'CategoryController@getList');
    Route::get('tags', 'TagController@getList');

});
