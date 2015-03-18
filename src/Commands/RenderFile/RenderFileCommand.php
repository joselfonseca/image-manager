<?php

namespace Joselfonseca\ImageManager\Commands\RenderFile;

/**
 * Description of UploadFileCommand
 *
 * @author desarrollo
 */
class RenderFileCommand {

    public $id;
    
    public $width;
    
    public $height;
    
    public $canvas;

    public function __construct($id, $width, $height, $canvas = false) {
        $this->id = $id;
        $this->width = $width;
        $this->height = $height;
        $this->canvas = $canvas;
    }

}
