<?php

/**
 * Module Routes
 */

Route::get('image-manager/view/{id}/thumb', [
    'as' => 'showthumb',
    'uses' => '\\Joselfonseca\\ImageManager\\Controllers\\ImageManagerController@thumb'
]);

Route::group(['before' => Config::get('image-manager::filter')], function() {
    Route::get('image-manager', [
        'as' => 'ImageManager',
        'uses' => '\\Joselfonseca\\ImageManager\\Controllers\\ImageManagerController@index'
    ]);
});
