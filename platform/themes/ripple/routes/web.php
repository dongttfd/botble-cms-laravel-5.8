<?php

Route::group(['namespace' => 'Theme\Ripple\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::get('ripple/test', 'RippleController@getTest');
    });
});

