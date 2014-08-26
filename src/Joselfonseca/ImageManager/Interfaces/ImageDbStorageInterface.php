<?php

namespace Joselfonseca\ImageManager\Interfaces;

/**
 *
 * @author desarrollo
 */
interface ImageDbStorageInterface {
    
    public function saveFileToDb($fileinfo);
    
    public function getFileInfo();
    
}
