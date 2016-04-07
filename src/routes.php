<?php

/**
 * Module Routes
 */
Route::get('image-manager/view/{id}/thumb', [
    'as' => 'showthumb',
    'uses' => '\\Joselfonseca\\ImageManager\\Controllers\\ImageManagerController@thumb'
]);

Route::get('image-manager/view/{id}/{width?}/{height?}/{canvas?}', [
    'as' => 'media',
    'uses' => '\\Joselfonseca\\ImageManager\\Controllers\\ImageManagerController@full'
])->where('width', '[0-9]+')->where('height', '[0-9]+')->where('canvas', 'canvas');

Route::group(['middleware' => config('image-manager.middleware')], function() {
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
