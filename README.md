Laravel image Manager package 
=============================

[![Build Status](https://travis-ci.org/joselfonseca/image-manager.svg?branch=master)](https://travis-ci.org/joselfonseca/image-manager)
[![Latest Stable Version](https://poser.pugx.org/joselfonseca/image-manager/v/stable.svg)](https://packagist.org/packages/joselfonseca/image-manager) 
[![Total Downloads](https://poser.pugx.org/joselfonseca/image-manager/downloads.svg)](https://packagist.org/packages/joselfonseca/image-manager) 
[![Latest Unstable Version](https://poser.pugx.org/joselfonseca/image-manager/v/unstable.svg)](https://packagist.org/packages/joselfonseca/image-manager) 
[![License](https://poser.pugx.org/joselfonseca/image-manager/license.svg)](https://packagist.org/packages/joselfonseca/image-manager)

A little Image Manager to use in forms and API's.

This is the stable version for Laravel 4.2.*, use the 2.0 branch for Laravel 5

Requirements
============================
    1. Jquery
    2. Bootstrap 3
    3. Laravel 4.2.*

The package will insert colorbox JS and Plupload JS, make sure you import colorbox.css to your templates.


Installation
============================
In your composer.json file add:

```js
"joselfonseca/image-manager" : "1.0.*"
```

Run `composer update`

Add the service provider

`'Joselfonseca\ImageManager\ImageManagerServiceProvider'`

Then run the migration
`php artisan migrate --package=joselfonseca/image-manager`

Then public the assets.

`php artisan asset:publish joselfonseca/image-manager`

Finally reference the assets in the layout

```html
<link href="{{asset('packages/joselfonseca/image-manager/css/imagemanager.css')}}" rel="stylesheet">
<link href="{{asset('packages/joselfonseca/image-manager/vendors/colorbox/colorbox.css')}}" rel="stylesheet">
<script src="{{asset('packages/joselfonseca/image-manager/js/imageManager.min.js')}}"></script>
```

Usage
================================

Make sure you have a field in your database to store the image id and inside your form add

```php
<label for='titulo'>Imagen del Post</label>
{{ImageManager::getField(['text' => 'Select the File', 'class' => 'btn btn-primary', 'field_name' => 'your_field_name', 'default' => '12'])}}
```

Parameters
```
    - text: the text for the button
    - class: the class to apply to the button
    - field_name: the field name for the image selected, this creates a hidden input with the field_name to get the id of the image selected when you post the form
    - default: the id for the image to be selected by default
```

How to render an image?

To render an image you can add to the src the route `action('showthumb', $id)`

```php
// this will show a thumb
<img src="{{action('showthumb', $default)}}" />
// this the full image
<img src="{{action('media', $default)}}" />
// this the full image resized by with
<img src="{{action('media', ['id' => $default, 'width' => 300])}}" />
// this the full image resized by with and height
<img src="{{action('media', ['id' => $default, 'width' => 300, 'heigth' => 300])}}" />
// this the full image resized by with and height in the canvas, not the image
<img src="{{action('media', ['id' => $default, 'width' => 300, 'heigth' => 300, 'canvas' => 'canvas'])}}" />
```

API
===============================

You can use the following methods with out the image selector modal.

```php

ImageManager::doUpload(); //this method receives the input file like Input::file('file')
ImageManager::resize($id, $width = null, $height = null); //this method will render the image according to the parameters
ImageManager::imageInfo($id); //this method will return an instance of Joselfonseca\ImageManager\Models\ImageManagerFiles which is the eloquent model for the image_manager_files table for the id given.

```

Please report Bugs!
===============================

This is a new component that needs PR and bug report, use the repo to raise any issues.

To Do
================================
```
    1. Unit Testing
    2. Image resizing and cropping
    3. Anything else cool!
```

Thanks!
================================

I would like to thank anyone who uses the component and report bugs. This will always be a work in progress.
