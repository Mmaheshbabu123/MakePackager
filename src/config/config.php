<?php

//use Nwidart\Modules\Activators\FileActivator;
use Packages\MakePackager\Commands;

return [

    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
    */

    'namespace' => 'Packages',
    'middleware'=>'lienionauth.api',

    /*
    |--------------------------------------------------------------------------
    | Module Stubs
    |--------------------------------------------------------------------------
    |
    | Default module stubs.
    |
    */

    'stubs' => [
        'enabled' => false,
        'path' => base_path('vendor/ifo/laravel-packager/src/Commands/stubs'),
        'files' => [
            'routes/web' => 'src/routes/web.php',
            'routes/api' => 'src/routes/api.php',
            'views/index' => 'src/Resources/views/index.blade.php',
            'views/master' => 'src/Resources/views/layouts/master.blade.php',
            'scaffold/config' => 'src/Config/config.php',
            'composer' => 'composer.json',
            'assets/js/app' => 'src/Resources/assets/js/app.js',
            'assets/sass/app' => 'src/Resources/assets/sass/app.scss',
          //  'webpack' => 'webpack.mix.js',
          //  'package' => 'package.json',
        ],
        'replacements' => [
            'routes/web' => ['LOWER_NAME', 'STUDLY_NAME'],
            'routes/api' => ['LOWER_NAME'],
            'webpack' => ['LOWER_NAME'],
            'json' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE', 'PROVIDER_NAMESPACE'],
            'views/index' => ['LOWER_NAME'],
            'views/master' => ['LOWER_NAME', 'STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME'],
            'composer' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'MODULE_NAMESPACE',
                'PROVIDER_NAMESPACE',
            ],
        ],
        'gitkeep' => true,
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Modules path
        |--------------------------------------------------------------------------
        |
        | This path used for save the generated module. This path also will be added
        | automatically to list of scanned folders.
        |
        */

        'modules' => base_path('packages'),
        /*
        |--------------------------------------------------------------------------
        | Modules assets path
        |--------------------------------------------------------------------------
        |
        | Here you may update the modules assets path.
        |
        */

        'assets' => public_path('packages'),
        /*
        |--------------------------------------------------------------------------
        | The migrations path
        |--------------------------------------------------------------------------
        |
        | Where you run 'module:publish-migration' command, where do you publish the
        | the migration files?
        |
        */

        'migration' => base_path('database/migrations'),
        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        | Customise the paths where the folders will be generated.
        | Set the generate key to false to not generate that folder
        */
        'generator' => [
            'config' => ['path' => 'src/Config', 'generate' => true],
            'command' => ['path' => 'src/Console', 'generate' => true],
            'migration' => ['path' => 'src/Database/migrations','namespace'=>'Database/migrations' ,'generate' => true],
            'seeder' => ['path' => 'src/Database/Seeders', 'generate' => true],
            'factory' => ['path' => 'src/Database/factories', 'generate' => true],
            'model' => ['path' => 'src/Models','namespace'=>'Models', 'generate' => true],
            'routes' => ['path' => 'src/routes', 'generate' => true],
            'controller' => ['path' => 'src/Http/Controllers','namespace'=>'Http/Controllers' ,'generate' => true],
            'abstractcontroller' => ['path' => 'src/Http/Controllers','namespace'=>'Http/Controllers', 'generate' =>true],
            'filter' => ['path' => 'src/Http/Middleware', 'generate' => true],
            'request' => ['path' => 'src/Http/Requests', 'generate' => true],
            'provider' => ['path' => 'src/Providers', 'namespace'=>'Providers','generate' => true],
            'assets' => ['path' => 'src/Resources/assets', 'generate' => true],
            'lang' => ['path' => 'src/Resources/lang', 'generate' => true],
            'views' => ['path' => 'src/Resources/views', 'generate' => true],
            'test' => ['path' => 'src/Tests/Unit', 'generate' => true],
            'test-feature' => ['path' => 'src/Tests/Feature', 'generate' => true],
            'repository' => ['path' => 'Repositories', 'generate' => false],
            'event' => ['path' => 'src/Events', 'namespace'=>'Events','generate' => true],
            'listener' => ['path' => 'src/Listeners', 'namespace'=>'Listeners','generate' => true],
            'policies' => ['path' => 'Policies', 'generate' => false],
            'rules' => ['path' => 'Rules', 'generate' => false],
            'jobs' => ['path' => 'src/Jobs','namespace'=>'Jobs', 'generate' => true],
            'emails' => ['path' => 'Emails', 'generate' => false],
            'notifications' => ['path' => 'Notifications', 'generate' => false],
            'resource' => ['path' => 'Transformers', 'generate' => false],
            'component-view' => ['path' => 'Resources/views/components', 'generate' => false],
            'component-class' => ['path' => 'View/Components', 'generate' => false],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Package commands
    |--------------------------------------------------------------------------
    |
    | Here you can define which commands will be visible and used in your
    | application. If for example you don't use some of the commands provided
    | you can simply comment them out.
    |
    */
    'commands' => [





        Commands\ModuleMakeCommand::class,
Commands\ProviderMakeCommand::class,
Commands\RouteProviderMakeCommand::class,
Commands\ControllerMakeCommand::class,
Commands\AbstractControllerMakeCommand::class,
Commands\JobMakeCommand::class,
Commands\EventMakeCommand::class,
Commands\ListenerMakeCommand::class,
Commands\ModelMakeCommand::class,
Commands\MigrationMakeCommand::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
    */

    'scan' => [
        'enabled' => true,
        'paths' => [
            base_path('packages/*/*'),
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Here is the config for composer.json file, generated by this package
    |
    */

    'composer' => [
        'vendor' => 'Infanion',
        'author' => [
            'name' => 'Infanion ',
            'email' => 'infanion@gmail.com',
        ],
        'composer-output' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
    */
    'cache' => [
        'enabled' => false,
        'key' => 'laravel-modules',
        'lifetime' => 60,
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require you to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true,
        /**
         * load files on boot or register method
         *
         * Note: boot not compatible with asgardcms
         *
         * @example boot|register
         */
        'files' => 'register',
    ],

    /*
    |--------------------------------------------------------------------------
    | Activators
    |--------------------------------------------------------------------------
    |
    | You can define new types of activators here, file, database etc. The only
    | required parameter is 'class'.
    | The file activator will store the activation status in storage/installed_modules
    */
    // 'activators' => [
    //     'file' => [
    //         'class' => FileActivator::class,
    //         'statuses-file' => base_path('modules_statuses.json'),
    //         'cache-key' => 'activator.installed',
    //         'cache-lifetime' => 604800,
    //     ],
    // ],

    'activator' => 'file',
];
