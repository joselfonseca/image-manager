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
    private $height;
    protected $image;
    protected $cached;
    protected $bgcolor;
    protected $position;


    protected function resize() {
        if (empty($this->canvas)) {
            $this->resizeNormal();
        } else {
            $this->resizeCanvas();
        }
    }
    // This is Dirty, will come back to it later
    protected function resizeNormal() {
        if (empty($this->path)) {
            $this->image = \Image::cache(function($image) {
                        if (!empty($this->width) && empty($this->height)) {
                            $image->canvas(800, 800, $this->bgcolor)->resize($this->width, null, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                        } elseif (empty($this->width) && !empty($this->height)) {
                            $image->canvas(800, 800, $this->bgcolor)->resize(null, $this->height, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                        } elseif (!empty($this->width) && !empty($this->height)) {
                            $image->canvas(800, 800, $this->bgcolor)->resize($this->width, $this->height);
                        }
                        return $image;
                    }, null, true);
        } else {
            $this->image = \Image::cache(function($image) {
                        if (!empty($this->width) && empty($this->height)) {
                            $image->make($this->destination . '/' . $this->path)->resize($this->width, null, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                        } elseif (empty($this->width) && !empty($this->height)) {
                            $image->make($this->destination . '/' . $this->path)->resize(null, $this->height, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                        } elseif (!empty($this->width) && !empty($this->height)) {
                            $image->make($this->destination . '/' . $this->path)->resize($this->width, $this->height);
                        }
                        return $image;
                    }, null, true);
        }
    }

    protected function resizeCanvas() {
        if (empty($this->path)) {
            $this->image = \Image::cache(function($image) {
                        return $image->canvas(800, 800, $this->bgcolor)->resizeCanvas($this->width, $this->height, $this->position, false, $this->bgcolor);
                    }, null, true);
        } else {
            $this->image = \Image::cache(function($image) {
                        return $image->make($this->destination . '/' . $this->path)->resizeCanvas($this->width, $this->height, $this->position, false, $this->bgcolor);
                    }, null, true);
        }
    }

    public function setProperties($destination = null, $path = null, $width = null, $heigth = null, $canvas = false, $bgcolor = '004890', $position = 'center') {
        $this->width = $width;
        $this->height = $heigth;
        $this->canvas = $canvas;
        $this->bgcolor = $bgcolor;
        $this->position = $position;
        $this->destination = $destination;
        $this->path = $path;
    }

    public function render() {
        $this->resize();
        return $this->image->response();
    }

}
