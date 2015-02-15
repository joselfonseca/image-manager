<?php


namespace Joselfonseca\ImageManager\Commands\DeleteFile\Events;

/**
 * Description of FileWasSavedToDisc
 *
 * @author desarrollo
 */
class FileWasRemovedFromDb {
    
    public $file;

    public function __construct($file){
        $this->file = $file;
    }
}
