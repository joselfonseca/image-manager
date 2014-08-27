<?php

namespace Joselfonseca\ImageManager\Commands\DeleteFile;

use Joselfonseca\ImageManager\Interfaces\ImageRepositoryInterface;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class DeleteFileCommandHandler implements CommandHandler{
    
    use DispatchableTrait;
    
    private $imageRepository;
    
    public function __construct(ImageRepositoryInterface $repository){
        $this->imageRepository = $repository;
    }

    public function handle($command) {
        return $this->imageRepository->DeleteFile($command);
    }

}
