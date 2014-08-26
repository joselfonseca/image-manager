<?php

namespace Joselfonseca\ImageManager;

/**
 * Description of ImageManager
 *
 * @author jfonseca
 */
class ImageManager {
    
    public static function getField($params){
        $text = ($params['text']) ? $params['text'] : 'Select File';
        $class = ($params['class']) ? $params['class'] : 'btn btn-default';
        return '<div class="ImageManager"><button class="fileManager '.$class.'" type="Button" data-url="'.action('ImageManager').'">'.$text.'</button></div>';
    }
    
}
