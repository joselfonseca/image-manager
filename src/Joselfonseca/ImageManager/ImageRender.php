<?php

namespace Joselfonseca\ImageManager;

/**
 * Description of ImageRender
 *
 * @author jfonseca
 */
class ImageRender {

    private $destination;
    private $path;
    private $width;
    private $heigth;
    protected $image;
    protected $cached;

    protected function createImage() {
        if (empty($this->path)) {
            $this->image = \Image::cache(function($image){
                return $image->canvas(800, 800, '#cecece');
            }, null, true);
        } else {
            $this->image = \Image::cache(function($image){
                return $image->make($this->destination . '/' . $this->path);
            }, null, true);
        }
    }

    protected function resize() {
        if (!empty($this->width) && empty($this->height)) {
            $this->image->resize($this->width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        } elseif (empty($this->width) && !empty($this->height)) {
            $this->image->resize(null, $this->height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        } elseif (!empty($this->width) && !empty($this->height)) {
            $this->image->resize($this->width, $this->height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
    }

    public function setProperties($destination = null, $path = null, $width = null, $heigth = null) {
        $this->width = $width;
        $this->heigth = $heigth;
        $this->destination = $destination;
        $this->path = $path;
    }

    public function render() {
        $this->createImage();
        $this->resize();
        return $this->image->response();
    }

}
