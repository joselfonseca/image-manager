<?php

namespace Joselfonseca\ImageManager\Commands\UploadFile;

use \Illuminate\Support\Facades\Validator;
use Joselfonseca\ImageManager\Exceptions\ValidationExeption;

/**
 * Description of UploadFileValidator
 *
 * @author desarrollo
 */
class UploadFileValidator {

    public function Validate($command) {
        $rules = [
            'file' => "image|required|between:1," . \Config::get('image-manager::maxFileSize') . ""
        ];
        $validator = Validator::make((array)$command, $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            throw new ValidationExeption('Validation Error', 500, null, $messages);
        }
    }

}
