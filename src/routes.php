<?php

Route::get('image-manager/view/{id}/thumb', 'Joselfonseca\ImageManager\Controllers\ImageManagerController@thumb')->name('showthumb');
Route::get('image-manager/view/{id}/{width?}/{height?}/{canvas?}', 'Joselfonseca\ImageManager\Controllers\ImageManagerController@full')
    ->name('media')
    ->where('width', '[0-9]+')
    ->where('height', '[0-9]+')
    ->where('canvas', 'canvas');
Route::get('image-manager', 'Joselfonseca\ImageManager\Controllers\ImageManagerController@index')->name('ImageManager');
Route::post('upload-image', 'Joselfonseca\ImageManager\Controllers\ImageManagerController@store')->name('ImageManagerUpload');
Route::get('image-manager-images', 'Joselfonseca\ImageManager\Controllers\ImageManagerController@getImages')->name('ImageManagerImages');
Route::delete('image-manager/delete/{id}', 'Joselfonseca\ImageManager\Controllers\ImageManagerController@delete')->name('ImageManagerDelete');
