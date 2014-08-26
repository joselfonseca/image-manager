<?php

namespace Joselfonseca\ImageManager\Commands\UploadFile;

use Joselfonseca\ImageManager\Interfaces\ImageRepositoryInterface;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UploadFileCommandHandler implements CommandHandler{
    
    use DispatchableTrait;
    
    private $imageRepository;
    
    public function __construct(ImageRepositoryInterface $repository){
        $this->imageRepository = $repository;
    }

    public function handle($command) {
        $file = $this->imageRepository->uploadFile($command);
        $this->dispatchEventsFor($file);
        return $file;
    }

}
