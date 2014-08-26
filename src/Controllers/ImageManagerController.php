<?php

namespace Joselfonseca\ImageManager\Controllers;

use Joselfonseca\ImageManager\Commands\UploadFile\UploadFileCommand;
use Laracasts\Commander\CommanderTrait;

/** exceptions **/

use Joselfonseca\ImageManager\Exceptions\ValidationExeption;
use Joselfonseca\ImageManager\Exceptions\AlocateFileException;

/**
 * Description of ImageManagerController
 *
 * @author jfonseca
 */
class ImageManagerController extends \Controller {
    
    use CommanderTrait;
    
    public function __construct() {
        
    }

    public function index() {
        return \View::make('image-manager::image_manager')->with('files', []);
    }
    
    public function store(){
        try{
            $file = $this->execute(UploadFileCommand::class, ['file' => \Input::file('file')]);
        }catch(ValidationExeption $e){
            $return = ['errorCode' => 'ValidationError', 'messages' => $e->getErrors()];
            return \Response::json($return, 400);
        }catch(AlocateFileException $e){
            $return = ['errorCode' => 'AlocateError', 'messages' => ['Could not save the file to location.']];
            return \Response::json($return, 500);
        }
        $return = ['file' => $file->getFileInfo()];
        return \Response::json($return);
    }

}
