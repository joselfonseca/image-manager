<?php

namespace Joselfonseca\ImageManager\Commands\DeleteFile;

/**
 * Description of UploadFileCommand
 *
 * @author desarrollo
 */
class DeleteFileCommand {

    public $id;

    public function __construct($id) {
        $this->id = $id;
    }

}
