<?php

namespace Joselfonseca\ImageManager\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of ImageManagerFiles
 *
 * @author desarrollo
 */
class ImageManagerFiles extends Model
{
    protected $table = 'image_manager_files';

    protected $fillable = ['name', 'originalName', 'type', 'path', 'size', 'from_manager'];

    public function saveFileToDb($file)
    {
        $f = $this->create($file);
        return $f;
    }

    public function getFileById($id)
    {
        return $this->findOrFail($id);
    }

    public function getFileInfo()
    {
        return [
            'name' => $this->name,
            'originalName' => $this->originalName,
            'type' => $this->type,
            'url' => route('media', $this->id),
            'thumb' => route('showthumb', $this->id),
            'size' => (int) $this->size,
            'date_uploaded' => $this->created_at->format('Y-m-d H:i:s'),
            'urlAll' => route('ImageManagerImages'),
        ];
    }

    public function deleteFile()
    {
        return $this->delete();
    }
}
