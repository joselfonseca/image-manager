<?php

namespace Joselfonseca\ImageManager\Repositories;

use Joselfonseca\ImageManager\Interfaces\ImageRepositoryInterface;
use Joselfonseca\ImageManager\Interfaces\ImageDbStorageInterface;
use Joselfonseca\ImageManager\Exceptions\AlocateFileException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laracasts\Commander\Events\EventGenerator;
use Joselfonseca\ImageManager\Commands\UploadFile\Events\FileWasSavedToDisc;
use Joselfonseca\ImageManager\Commands\DeleteFile\Events\FileWasRemovedFromDisc;
use Joselfonseca\ImageManager\Commands\DeleteFile\Events\FileWasRemovedFromDb;
/** Image Manipulation * */
use Joselfonseca\ImageManager\Exceptions\ModelNotFoundException as JoseModelNotFoundException;
use Joselfonseca\ImageManager\ImageRender;

/**
 * Description of ImageRepository
 *
 * @author jfonseca
 */
class ImageRepository implements ImageRepositoryInterface {

    use EventGenerator;

    /**
     * @var ImageDbStorageInterface
     */
    private $model;
    /**
     * @var string
     */
    private $destination = IM_UPLOADPATH;
    /**
     * @var
     */
    private $command;
    /**
     * @var
     */
    private $file;

    /**
     * @param ImageDbStorageInterface $model
     */
    public function __construct(ImageDbStorageInterface $model) {
        $this->model = $model;
    }

    /**
     * @param $command
     * @return mixed
     * @throws AlocateFileException
     */
    public function uploadFile($command) {
        $filename = $command->file->getClientOriginalName();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $finalFile = md5(md5($filename . date('U'))) . '.' . $ext;
        $upload_success = $command->file->move($this->destination, $finalFile);
        if (empty($upload_success)) {
            throw new AlocateFileException;
        }
        $file = [
            'name' => $finalFile,
            'originalName' => $filename,
            'type' => $upload_success->getMimeType(),
            'path' => $finalFile,
            'size' => $upload_success->getSize(),
            'from_manager' => $command->fromManager
        ];
        $this->raise(new FileWasSavedToDisc($file));
        return $this->model->saveFileToDb($file);
    }

    /**
     * @param $command
     * @return mixed
     */
    public function renderImage($command) {
        $this->command = $command;
        $render = new ImageRender();
        try {
            $i = $this->model->findOrFail($this->command->id);
            $render->setProperties($this->destination, $i->path, $this->command->width, $this->command->height, $this->command->canvas);
        } catch (ModelNotFoundException $e) {
            $render->setProperties(null, null, $this->command->width, $this->command->height, $this->command->canvas);
        }
        return $render->render();
    }

    /**
     * @return mixed
     */
    public function getFiles() {
        return $this->model->orderBy('created_at', 'desc')->where('from_manager', 1)->paginate(12);
    }

    /**
     * @param $comand
     * @throws JoseModelNotFoundException
     */
    public function deleteFile($comand) {
        try {
            $this->file = $this->model->getFileById($comand->id);
        } catch (ModelNotFoundException $e) {
            throw new JoseModelNotFoundException;
        }
        $this->removeFileFromDisk();
        $this->removeFileFromDb();
    }

    /**
     *
     */
    private function removeFileFromDisk() {
        $file = $this->destination . '/' . $this->file->path;
        if(file_exists($file)){
            unlink($file);
        }
        $this->raise(new FileWasRemovedFromDisc($this->file));
    }

    /**
     *
     */
    private function removeFileFromDb() {
        $file = $this->file->getFileInfo();
        $this->file->DeleteFile();
        $this->raise(new FileWasRemovedFromDb($file));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getFileModel($id) {
        return $this->model->getFileById($id);
    }

}
