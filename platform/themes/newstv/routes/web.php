<?php

Route::group(['namespace' => 'Theme\NewsTv\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::get('news-tv/test', 'NewsTvController@getTest');
    });
});
