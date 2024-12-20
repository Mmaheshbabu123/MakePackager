<?php

namespace Packages\MakePackager\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use  Packages\MakePackager\Commands;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * The available commands
     * @var array
     */
    protected $commands = [


        Commands\ModuleMakeCommand::class,
       Commands\ProviderMakeCommand::class,
      Commands\RouteProviderMakeCommand::class,
      Commands\ControllerMakeCommand::class,
      Commands\AbstractControllerMakeCommand::class,
      Commands\JobMakeCommand::class,
      Commands\EventMakeCommand::class,
    Commands\ModelMakeCommand::class,
      Commands\ListenerMakeCommand::class,
      Commands\MigrationMakeCommand::class,
          Commands\TestMakeCommand::class,
    ];

    public function register(): void
    {
        $this->commands(config('modules.commands', $this->commands));
    }

    public function provides(): array
    {
        return $this->commands;
    }
}
