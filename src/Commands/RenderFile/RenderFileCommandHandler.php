<?php

namespace Joselfonseca\ImageManager\Commands\RenderFile;

use Joselfonseca\ImageManager\Interfaces\ImageRepositoryInterface;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class RenderFileCommandHandler implements CommandHandler{
    
    use DispatchableTrait;
    
    private $imageRepository;
    
    public function __construct(ImageRepositoryInterface $repository){
        $this->imageRepository = $repository;
    }

    public function handle($command) {
        return $this->imageRepository->renderImage($command);
    }

}
