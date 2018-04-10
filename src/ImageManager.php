<?php

namespace Joselfonseca\ImageManager;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Joselfonseca\ImageManager\Models\ImageManagerFiles;

/**
 * Class ImageManager
 *
 * @package Joselfonseca\ImageManager
 */
class ImageManager
{
    /**
     * @param $params
     * @return string
     */
    public static function getField($params)
    {
        $text = ($params['text']) ? $params['text'] : 'Select File';
        $class = ($params['class']) ? $params['class'] : 'btn btn-default';
        $field_name = (isset($params['field_name'])) ? $params['field_name'] : 'image';
        $default = (isset($params['default'])) ? $params['default'] : request()->old($params['field_name']);
        if (! empty($default)) {
            $image = '<img src="'.route('showthumb', $default).'" class="imageManagerImage" />';
        } else {
            $image = '<img src="" style="display:none" class="imageManagerImage" />';
        }

        return '<div class="ImageManager">'.$image.'<br /><br />'.'<button class="fileManager '.$class.'" type="Button" data-url="'.route('ImageManager').'" data-multi="false">'.$text.'</button>'.\Form::hidden($field_name, $default, ['class' => 'inputFile']).'</div>';
    }

    /**
     * @param $params
     * @return string
     */
    public static function getMultiField($params)
    {
        $params['field_name'] = (isset($params['field_name'])) ? $params['field_name'] : 'images';
        $params['default'] = (isset($params['default'])) ? $params['default'] : [];
        $params['default'] = array_map(function ($file) {
            try {
                return ImageManagerFiles::where('id', $file)->first();
            } catch (ModelNotFoundException $e) {
                return null;
            }
        }, $params['default']);
        return view('image-manager::image_manager_multi')->with('params', $params)->render();
    }
}
