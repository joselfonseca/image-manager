<?php

namespace Joselfonseca\ImageManager;

/**
 * Description of ImageManager
 *
 * @author jfonseca
 */
class ImageManager {

    public static function getField($params) {
        $text = ($params['text']) ? $params['text'] : 'Select File';
        $class = ($params['class']) ? $params['class'] : 'btn btn-default';
        $field_name = (isset($params['field_name'])) ? $params['field_name'] : 'image';
        $default = (isset($params['default'])) ? $params['default'] : null;
        if(!empty($default)){
            $image = '<img src="'.action('showthumb', $default).'" class="imageManagerImage" />';
        }else{
            $image = '<img src="" style="display:none" class="imageManagerImage" />';
        }
        return '<div class="ImageManager">'
                . $image .'<br /><br />'
                . '<button class="fileManager ' . $class . '" type="Button" data-url="' . action('ImageManager') . '">' . $text . '</button>'
                . \Form::hidden($field_name, $default, ['class' => 'inputFile'])
                . '</div>';
    }

}
