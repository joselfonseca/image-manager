<?php

namespace Joselfonseca\ImageManager\Commands\UploadFile\Events;

use Joselfonseca\ImageManager\Interfaces\ImageDbStorageInterface;

/**
 * Description of FileWasSavedToDb
 *
 * @author desarrollo
 */
class FileWasSavedToDb {

    public $file;

    public function __construct(ImageDbStorageInterface $file){
        $this->file = $file;
    }

}
