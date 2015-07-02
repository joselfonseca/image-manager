Laravel image Manager package 
=============================

[![Build Status](https://travis-ci.org/joselfonseca/image-manager.svg?branch=master)](https://travis-ci.org/joselfonseca/image-manager)
[![Latest Stable Version](https://poser.pugx.org/joselfonseca/image-manager/v/stable.svg)](https://packagist.org/packages/joselfonseca/image-manager) 
[![Total Downloads](https://poser.pugx.org/joselfonseca/image-manager/downloads.svg)](https://packagist.org/packages/joselfonseca/image-manager) 
[![Latest Unstable Version](https://poser.pugx.org/joselfonseca/image-manager/v/unstable.svg)](https://packagist.org/packages/joselfonseca/image-manager) 
[![License](https://poser.pugx.org/joselfonseca/image-manager/license.svg)](https://packagist.org/packages/joselfonseca/image-manager)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/32a20858-db3e-4e28-8211-9517268b3f6f/small.png)](https://insight.sensiolabs.com/projects/32a20858-db3e-4e28-8211-9517268b3f6f)

A little Image Manager to use in forms and API's.

This is the stable version for Laravel 5.x, if you want the 4.2 version check out the 1.0 branch

Requirements
============================
    1. Jquery
    2. Bootstrap 3
    3. Laravel 5.*

The package will insert colorbox JS and Plupload JS, make sure you import colorbox.css to your templates.


Installation
============================
In your composer.json file add:

```js
"joselfonseca/image-manager" : "2.0.*"
```

Run `composer update`

Add the service provider

`'Joselfonseca\ImageManager\ImageManagerServiceProvider'`

Then publish the package assets, config and migration.
```bash
php artisan vendor:publish --provider=Joselfonseca\ImageManager\ImageManagerServiceProvider --force --tag=IMpublic
php artisan vendor:publish --provider=Joselfonseca\ImageManager\ImageManagerServiceProvider --force --tag=IMconfig
php artisan vendor:publish --provider=Joselfonseca\ImageManager\ImageManagerServiceProvider --force --tag=IMmigration
```

Migrate the database

`php artisan migrate`

Finally reference the assets in the layout

```html
<link href="{{asset('vendor/image-manager/css/imagemanager.css')}}" rel="stylesheet">
<link href="{{asset('vendor/image-manager/vendors/colorbox/colorbox.css')}}" rel="stylesheet">
<script src="{{asset('vendor/image-manager/js/imageManager.min.js')}}"></script>
```

Usage
================================

Make sure you have a field in your database to store the image id and inside your form add

```php
<label for='titulo'>Image</label>
{!! ImageManager::getField(['text' => 'Select the File', 'class' => 'btn btn-primary', 'field_name' => 'your_field_name', 'default' => '12']) !!}
// the default parameter is the image id in your table for your resource.
```

Parameters
```
    - text: the text for the button
    - class: the class to apply to the button
    - field_name: the field name for the image selected, this creates a hidden input with the field_name to get the id of the image selected when you post the form
    - default: the id for the image to be selected by default
```

How to render an image?

To render an image you can add to the src the route `route('showthumb', $id)`

```php
// this will show a thumb
<img src="{{route('showthumb', $default)}}" />
// this the full image
<img src="{{route('media', $default)}}" />
// this the full image resized by with
<img src="{{route('media', ['id' => $default, 'width' => 300])}}" />
// this the full image resized by with and height
<img src="{{route('media', ['id' => $default, 'width' => 300, 'heigth' => 300])}}" />
// this the full image resized by with and height in the canvas, not the image
<img src="{{route('media', ['id' => $default, 'width' => 300, 'heigth' => 300, 'canvas' => 'canvas'])}}" />
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
