<?php

namespace Joselfonseca\ImageManager;

use Joselfonseca\ImageManager\Commands\UploadFile\UploadFileCommand;
use Laracasts\Commander\CommanderTrait;
use Joselfonseca\ImageManager\Interfaces\ImageRepositoryInterface;
use Joselfonseca\ImageManager\Commands\RenderFile\RenderFileCommand;

/**
 * Description of ImageManager
 *
 * @author jfonseca
 */
class ImageManager {
    
    use CommanderTrait;

    private $ImageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository) {
        $this->ImageRepository = $imageRepository;
    }
    
    public function doUpload() {
        return $this->execute(UploadFileCommand::class, ['file' => \Input::file('file')]);
    }
    
    public function resize($id, $width = null, $height = null){
        return $this->execute(RenderFileCommand::class, ['id' => $id, 'width' => $width, 'height' => $height]);
    }
    
    public function imageInfo($id){
        return $this->ImageRepository->getFileModel($id);
    }

    public static function getField($params) {
        $text = ($params['text']) ? $params['text'] : 'Select File';
        $class = ($params['class']) ? $params['class'] : 'btn btn-default';
        $field_name = (isset($params['field_name'])) ? $params['field_name'] : 'image';
        $default = (isset($params['default'])) ? $params['default'] : \Input::old($params['field_name']);;
        if(!empty($default)){
            $image = '<img src="'.action('media', ['id' => $default, 'width' => 300]).'" class="imageManagerImage" />';
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
