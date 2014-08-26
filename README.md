Laravel image Manager package
=============================

After adding the dependency, run
`php artisan migrate --package=joselfonseca/image-manager`

Add the service provider

`'Joselfonseca\ImageManager\ImageManagerServiceProvider'`


After that run

`php artisan asset:publish joselfonseca/image-manager`

To add the option into your form do:

`{{ImageManager::getField(['text' => 'Select the File', 'class' => 'btn btn-primary'])}}`

