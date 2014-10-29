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
        
        /** Check for the folder **/
        define('IM_UPLOADPATH', app_path('storage/file_manager'));
        
        if(!is_dir(IM_UPLOADPATH)){
            mkdir(IM_UPLOADPATH);
            chmod(IM_UPLOADPATH, 0777);
        }
        
        /** bind Stuff **/
        
        \App::bind('Joselfonseca\ImageManager\Interfaces\ImageRepositoryInterface', 'Joselfonseca\ImageManager\Repositories\ImageRepository');
        \App::bind('Joselfonseca\ImageManager\Interfaces\ImageDbStorageInterface', 'Joselfonseca\ImageManager\Models\ImageManagerFiles');
        
        /** register event listeners **/
        //This may be use in the future. for now lets forget about it
        //Event::listen('Joselfonseca\ImageManager.*', 'Joselfonseca\ImageManager\Listeners\EmailNotifier');
        
        /** include the routes **/
        require_once __DIR__.'/../../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        /** Register the service provider for the laracast commander **/
        $this->app->register('Laracasts\Commander\CommanderServiceProvider');
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
