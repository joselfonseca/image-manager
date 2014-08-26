<?php

namespace Joselfonseca\ImageManager\Commands\UploadFile;

/**
 * Description of UploadFileCommand
 *
 * @author desarrollo
 */
class UploadFileCommand {

    public $file;

    public function __construct($file) {
        $this->file = $file;
    }

}
