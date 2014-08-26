<?php

namespace Joselfonseca\ImageManager;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;


class ImageManagerServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('joselfonseca/image-manager');
        
        AliasLoader::getInstance()->alias('ImageManager', 'Joselfonseca\ImageManager\ImageManager');
        
        /** Chek for the folder **/
        
        if(!is_dir(app_path('storage/file_manager'))){
            mkdir(app_path('storage/file_manager'));
            chmod(app_path('storage/file_manager'), 0777);
        }
        
        require_once __DIR__.'/../../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array();
    }

}
