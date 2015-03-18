<?php

namespace Joselfonseca\ImageManager\Exceptions;

/**
 * Description of ValidationExeption
 *
 * @author desarrollo
 */
class ValidationExeption extends \Exception{
    
    private $validationErrors;
    
    public function __construct($message, $code, $previous, $validationErrors) {
        parent::__construct($message, $code, $previous);
        $this->validationErrors = $validationErrors;
    }
    
    public function getErrors(){
        return $this->validationErrors;
    }
    
}
