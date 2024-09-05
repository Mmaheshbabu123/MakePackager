<?php

namespace Packages\MakePackager\Providers;
use Packages\MakePackager\Providers\ModuleServiceProvider;
use Illuminate\Support\ServiceProvider;
use Packages\MakePackager\Contracts\RepositoryInterface;
use Packages\MakePackager\Laravel;
use SimpleXMLElement;
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
      $this->loadTestDirectories();
      logger('register');
    }
    public function boot()
    {
        logger('boot');
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
      logger('register serverices');
        $this->app->alias(Contracts\RepositoryInterface::class, 'modules');
    }

    /**
       * Dynamically load test directories into phpunit.xml.
       *
       * @return void
       */
      protected function loadTestDirectories()
      {
          // Use base_path() to dynamically get the root directory of the Laravel application
          $xmlFile = base_path('phpunit.xml');

          // Load the XML file
          if (!file_exists($xmlFile)) {
              logger("File not found: $xmlFile");
              return;
          }

          $xmlContent = file_get_contents($xmlFile);

          // Create a new SimpleXMLElement object
          libxml_use_internal_errors(true);
          $xml = simplexml_load_string($xmlContent);
          if ($xml === false) {
              $errors = libxml_get_errors();
              foreach ($errors as $error) {
                  logger("XML Error: " . $error->message);
              }
              libxml_clear_errors();
              return;
          }

          // Define dynamic directories for Unit and Feature test suites
          $unitDirectories = [
              'packages/*/src/Tests/Unit',
          ];

          $featureDirectories = [
              'packages/*/src/Tests/Feature',
          ];

          // Add directories to Unit test suite if not already present
          $this->addDirectoriesToSuite($xml, 'Unit', $unitDirectories);

          // Add directories to Feature test suite if not already present
          $this->addDirectoriesToSuite($xml, 'Feature', $featureDirectories);

          // Save the modified XML
          file_put_contents($xmlFile, $xml->asXML());
      }

      /**
       * Add directories to a specified test suite if not already present.
       *
       * @param SimpleXMLElement $xml
       * @param string $suiteName
       * @param array $directories
       * @return void
       */
      protected function addDirectoriesToSuite(SimpleXMLElement $xml, $suiteName, array $directories)
      {
          foreach ($xml->testsuites->testsuite as $suite) {
              if ((string)$suite['name'] === $suiteName) {
                  // Existing directories in the suite
                  $existingDirectories = [];
                  foreach ($suite->directory as $dir) {
                      $existingDirectories[] = (string)$dir;
                  }

                  // Add new directories if they are not already present
                  foreach ($directories as $dir) {
                      if (!in_array($dir, $existingDirectories)) {
                          $suite->addChild('directory', $dir);
                      }
                  }
              }
          }
      }
}
