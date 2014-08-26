<?php

/**
 * The filter that should be applied to the routes in the module, 
 * its important to protect the file uploading with the filter!
 */
return [
    'filter' => ['admin_logged'],
    'maxFileSize' => 10096 //Max upload file size
];
