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

    public function __construct($id, $width, $height) {
        $this->id = $id;
        $this->width = $width;
        $this->height = $height;
    }

}
