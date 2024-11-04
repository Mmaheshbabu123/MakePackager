<?php

namespace Packages\MakePackager\Providers;
use Packages\MakePackager\Providers\ModuleServiceProvider;
use Illuminate\Support\ServiceProvider;
use Packages\MakePackager\Contracts\RepositoryInterface;
use Packages\MakePackager\Laravel;
class MakePackagerServiceProvider extends ModuleServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();
        $this->registerServices();
        $this->registerNamespaces();
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'modules');

    }
    public function boot()
    {
      //  $this->boot(__DIR__.'/../Database/migrations');
      // //  parent::boot();
      // $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
      // $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
    return [Contracts\RepositoryInterface::class, 'modules'];

    }

    public function registerServices() {
      $this->app->singleton(Contracts\RepositoryInterface::class, function ($app) {
          $path = $app['config']->get('modules.paths.modules');

          return new Laravel\LaravelFileRepository($app, $path);
      });
        $this->app->alias(Contracts\RepositoryInterface::class, 'modules');
    }
}
