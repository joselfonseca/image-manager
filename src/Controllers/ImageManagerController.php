<?php

namespace Joselfonseca\ImageManager\Controllers;

use Joselfonseca\ImageManager\Repositories\ImageRepository;

/**
 * Description of ImageManagerController
 *
 * @author jfonseca
 */
class ImageManagerController extends \Controller {

    public function index() {
        /** get files Uploaded **/
        $files = ImageRepository::paginate(15);
        return \View::make('image-manager::image_manager')->with('files', $files);
    }

}
