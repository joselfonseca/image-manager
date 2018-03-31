<?php

/**
 * The filter that should be applied to the routes in the module, 
 * its important to protect the file uploading with the filter!
 */
return [
    'middleware' => ['auth'],
    'maxFileSize' => 1000096 //Max upload file size
];
