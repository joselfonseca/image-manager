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
        \Intervention\Image\ImageServiceProvider::class,
    ];

    protected $aliases = [
        'Image' => \Intervention\Image\Facades\Image::class,
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/image-manager'),
        ], 'public');
        $this->publishes([
            __DIR__.'/../resources/views/' => base_path('resources/views/vendor/image-manager'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('image-manager.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../migrations/' => base_path('database/migrations'),
        ], 'migration');
        $this->publishes([
            __DIR__.'/../resources/lang' => base_path('resources/lang'),
        ], 'Lang');
        $this->loadViewsConfiguration()->registerTranslations();
        /** include the routes * */
        require_once __DIR__.'/routes.php';
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

    private function loadViewsConfiguration()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'image-manager');

        return $this;
    }

    /**
     * Register the translations
     *
     * @return $this
     */
    private function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ImageManager');

        return $this;
    }
}
