Laravel image Manager package 
=============================

A little Image Manager to use in forms.

Requirements
============================
    1. Jquery
    2. Twitter Bootstrap

The package will insert colorbox JS and Plupload JS, make sure you import colorbox.css to your templates.


Installation
============================
In your composer.json file add:

```js
"joselfonseca/image-manager" : "dev-master"
```

Run `composer update`

Then run the migration
`php artisan migrate --package=joselfonseca/image-manager`

Add the service provider

`'Joselfonseca\ImageManager\ImageManagerServiceProvider'`

Then public the assets.

`php artisan asset:publish joselfonseca/image-manager`

Finally reference the assets in the layout

```html
<link href="/packages/joselfonseca/image-manager/vendors/colorbox/colorbox.css" rel="stylesheet">
<script src="/packages/joselfonseca/image-manager/js/imageManager.min.js"></script>
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

To render an image t you can add to the src the route `action('showthumb', $id)`

```php
// this will show a thumb
<img src="{{action('showthumb', $default)}}" />
// this the full image
<img src="{{action('media', $default)}}" />
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

I would like to thank anyone that uses the component and report bugs. This will always be a work in progress.