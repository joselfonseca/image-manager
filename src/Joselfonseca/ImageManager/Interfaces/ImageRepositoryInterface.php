<?php

namespace Joselfonseca\ImageManager\Interfaces;

/**
 *
 * @author desarrollo
 */
interface ImageRepositoryInterface {
    
    public function uploadFile($command);
    
    public function renderImage($command);
    
    public function getFiles();
    
    public function DeleteFile($command);
    
}
