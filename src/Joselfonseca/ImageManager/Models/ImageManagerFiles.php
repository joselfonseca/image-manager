<?php

namespace Joselfonseca\ImageManager\Models;

use Joselfonseca\ImageManager\Interfaces\ImageDbStorageInterface;

use Laracasts\Commander\Events\EventGenerator;
use Joselfonseca\ImageManager\Commands\UploadFile\Events\FileWasSavedToDb;

/**
 * Description of ImageManagerFiles
 *
 * @author desarrollo
 */
class ImageManagerFiles extends \Eloquent implements ImageDbStorageInterface{
    
    protected $table = 'image_manager_files';
    
    protected $fillable = ['name', 'originalName', 'type', 'path', 'size'];
    
    use EventGenerator;
    
    public function saveFileToDb($file) {
        $f = $this->create($file);
        $f->raise(new FileWasSavedToDb($f));
        return $f;
    }
    
    public function getFileInfo(){
        return [
            'name' => $this->name,
            'originalName' => $this->originalName,
            'type' => $this->type,
            'url' => action('media', $this->id),
            'thumb' => action('showthumb', $this->id),
            'size' => (int) $this->size,
            'date_uploaded' => $this->created_at->format('Y-m-d H:i:s'),
            'html' => \View::make('image-manager::image')->with('file', $this)->render()
        ];
    }

}
