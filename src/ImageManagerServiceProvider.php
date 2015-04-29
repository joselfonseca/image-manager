<?php

namespace Joselfonseca\ImageManager;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ImageManagerServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $providers = [
        'Laracasts\Commander\CommanderServiceProvider',
        'Intervention\Image\ImageServiceProvider',
    ];
    protected $aliases = [
        'Image' => 'Intervention\Image\Facades\Image',
        'ImageManager' => 'Joselfonseca\ImageManager\ImageManager',
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->checkAndCreateFolder()
             ->loadViewsConfiguration()
             ->publishesConfiguration()
             ->publishesMigrations()
             ->publishesAssets();
        /** bind Stuff * */
        $this->app->bind('Joselfonseca\ImageManager\Interfaces\ImageRepositoryInterface', 'Joselfonseca\ImageManager\Repositories\ImageRepository');
        $this->app->bind('Joselfonseca\ImageManager\Interfaces\ImageDbStorageInterface', 'Joselfonseca\ImageManager\Models\ImageManagerFiles');

        /** include the routes * */
        require_once __DIR__ . '/routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerOtherProviders()->registerAliases();
    }

    private function registerOtherProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
        return $this;
    }

    protected function registerAliases()
    {
        foreach ($this->aliases as $alias => $original) {
            AliasLoader::getInstance()->alias($alias, $original);
        }
        return $this;
    }

    private function checkAndCreateFolder()
    {
        /** Check for the folder * */
        defined('IM_UPLOADPATH') or define('IM_UPLOADPATH', storage_path('file_manager'));
        if (!is_dir(IM_UPLOADPATH)) {
            mkdir(IM_UPLOADPATH);
            chmod(IM_UPLOADPATH, 0777);
        }
        return $this;
    }

    private function loadViewsConfiguration()
    {
        $this->loadViewsFrom(__DIR__ . '/views/', 'image-manager');
        $this->publishes([
            __DIR__ . '/views/' => base_path('resources/views/vendor/ImageManager'),
        ]);
        return $this;
    }

    private function publishesConfiguration()
    {
        $this->publishes([
            __DIR__ . '/config/image-manager.php' => config_path('image-manager.php'),
        ]);
        return $this;
    }

    private function publishesMigrations()
    {
        $this->publishes([
            __DIR__ . '/migrations/' => base_path('database/migrations'),
        ]);
        return $this;
    }

    private function publishesAssets()
    {
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/image-manager'),
        ]);
        return $this;
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
