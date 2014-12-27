<?php

/**
 * Module Routes
 */
Route::get('image-manager/view/{id}/thumb', [
    'as' => 'showthumb',
    'uses' => '\\Joselfonseca\\ImageManager\\Controllers\\ImageManagerController@thumb'
]);

Route::get('image-manager/view/{id}', [
    'as' => 'media',
    'uses' => '\\Joselfonseca\\ImageManager\\Controllers\\ImageManagerController@full'
]);

Route::group(['before' => Config::get('image-manager::filter')], function() {
    Route::get('image-manager', [
        'as' => 'ImageManager',
        'uses' => '\\Joselfonseca\\ImageManager\\Controllers\\ImageManagerController@index'
    ]);
    Route::post('upload-image', [
        'as' => 'ImageManagerUpload',
        'uses' => '\\Joselfonseca\\ImageManager\\Controllers\\ImageManagerController@store'
    ]);
    Route::get('image-manager-images', [
        'as' => 'ImageManagerImages',
        'uses' => '\\Joselfonseca\\ImageManager\\Controllers\\ImageManagerController@getImages'
    ]);
    Route::get('image-manager/delete/{id}', [
        'as' => 'ImageManagerDelete',
        'uses' => '\\Joselfonseca\\ImageManager\\Controllers\\ImageManagerController@delete'
    ]);
});
