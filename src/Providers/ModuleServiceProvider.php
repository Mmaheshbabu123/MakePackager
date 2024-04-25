<?php
namespace Packages\MakePackager\Providers;
use Packages\MakePackager\Providers\ConsoleServiceProvider;

use Illuminate\Support\ServiceProvider;


abstract class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Booting the package.
     */
    public function boot()
    {
    }

    /**
     * Register all modules.
     */
    public function register()
    {

    }

    /**
     * Register all modules.
     */
    protected function registerModules()
    {
        //$this->app->register(BootstrapServiceProvider::class);
    }

    /**
     * Register package's namespaces.
     */
    protected function registerNamespaces()
    {
      logger('name space abstract');
        // $configPath = __DIR__ . '/../config/config.php';
        //
        // $this->publishes([
        //     $configPath => config_path('modules.php'),
        // ], 'config');
    }

    /**
     * Register the service provider.
     */
    abstract protected function registerServices();

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        //return [Contracts\RepositoryInterface::class, 'modules'];
    }

    /**
     * Register providers.
     */
    protected function registerProviders()
    {
        logger('register providers-----');
       $this->app->register(ConsoleServiceProvider::class);
        // $this->app->register(ContractsServiceProvider::class);
    }
}
