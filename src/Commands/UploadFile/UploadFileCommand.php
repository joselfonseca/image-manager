<?php

namespace Joselfonseca\ImageManager\Commands\UploadFile;

/**
 * Description of UploadFileCommand
 *
 * @author desarrollo
 */
class UploadFileCommand {

    public $file;

    public $fromManager;

    public function __construct($file, $fromManager = 1) {
        $this->file = $file;
        $this->fromManager = $fromManager;
    }

}
