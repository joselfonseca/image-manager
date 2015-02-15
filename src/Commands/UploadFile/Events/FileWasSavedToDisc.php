<?php


namespace Joselfonseca\ImageManager\Commands\UploadFile\Events;

/**
 * Description of FileWasSavedToDisc
 *
 * @author desarrollo
 */
class FileWasSavedToDisc {
    
    public $file;

    public function __construct($file){
        $this->file = $file;
    }
}
