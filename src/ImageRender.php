<?php

namespace Joselfonseca\ImageManager;

use Image;
use Illuminate\Support\Facades\Storage;

/**
 * Description of ImageRender
 *
 * @author jfonseca
 */
class ImageRender
{
    /**
     * @var string
     */
    protected $color = '004890';

    /**
     * @var string
     */
    protected $position = 'center';

    /**
     * @param $path
     * @param null $width
     * @param null $height
     * @param bool $canvas
     * @return mixed
     */
    public function render($path, $width = null, $height = null, $canvas = false)
    {
        if(!Storage::has($path)) {
            return $this->renderDefault($width, $height);
        }
        if($canvas) {
            return Image::cache(function ($image) use ($path, $width, $height) {
                return $image->make(Storage::get($path))->resizeCanvas($width, $height, $this->position, false, $this->color);
            }, 10, true)->response();
        }
        return Image::cache(function ($image) use ($path, $width, $height) {
            return $image->make(Storage::get($path))->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }, 10, true)->response();
    }

    /**
     * @param null $width
     * @param null $height
     * @return mixed
     */
    public function renderDefault($width = null, $height = null)
    {
        return Image::cache(function ($image) use ($width, $height) {
            return $image->canvas(800, 800, $this->color)->resizeCanvas($width, $height, $this->position, false, $this->color);
        }, 10, true)->response();
    }
}
