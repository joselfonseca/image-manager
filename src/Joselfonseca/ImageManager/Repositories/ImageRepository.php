<?php

namespace Joselfonseca\ImageManager\Repositories;

use Joselfonseca\ImageManager\Interfaces\ImageRepositoryInterface;
use Joselfonseca\ImageManager\Interfaces\ImageDbStorageInterface;

use Joselfonseca\ImageManager\Exceptions\AlocateFileException;

use Laracasts\Commander\Events\EventGenerator;

use Joselfonseca\ImageManager\Commands\UploadFile\Events\FileWasSavedToDisc;

/**
 * Description of ImageRepository
 *
 * @author jfonseca
 */
class ImageRepository implements ImageRepositoryInterface{
    
    use EventGenerator;
    
    private $model;
    
    private $destination = IM_UPLOADPATH;
    
    public function __construct(ImageDbStorageInterface $model) {
        $this->model = $model;
    }

    public function uploadFile($command){
        $filename = $command->file->getClientOriginalName();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $finalFile = md5(md5($filename . date('U'))) . '.' . $ext;
        $upload_success = $command->file->move($this->destination, $finalFile);
        if(empty($upload_success)){
            throw new AlocateFileException;
        }
        $file = [
            'name' => $finalFile,
            'originalName' => $filename,
            'type' => $upload_success->getMimeType(),
            'path' => $finalFile,
            'size' => $upload_success->getSize()
        ];
        $this->raise(new FileWasSavedToDisc($file));
        return $this->model->saveFileToDb($file);
    }
    
}
