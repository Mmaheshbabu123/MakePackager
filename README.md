# How to Setup MakePackager Module in Your Laravel Project

This package is a CLI tool that helps you build a fully structured package for a Laravel application without spending a lot of time. You no longer need to struggle with initializing the skeleton for your package. Instead, focus on writing the source code while Laravel Packager organizes the package structure for you.

## Step 0: Pre-Installation Setup

Before installing, please add the necessary file to your root project. You can find the file and instructions at the following link:

[Custom Route Provider Setup](https://github.com/Mmaheshbabu123/make-packager-custom-route-provider/blob/main/README.md)

## Step 1: Install the Package

Run the following command to install the package:

```bash
composer require ifo/laravel-make-packager
```

STEP 2: composer dump-Autoload
successfully package installed

# How to Create a Custom Package

STEP 1:
      Run the following command:
      ```bash
      php artisan package:make Your pakage name
      ```
      This command will create the folder structure and necessary files for your package, including routes, ServiceProvider, and an AbstractController for enforcing rules and validations.
      
      see the below screenshot
      
![Screenshot from 2024-04-26 15-39-45](https://github.com/Mmaheshbabu123/MakePackager/assets/29708637/f12f0829-9023-4a55-bfaf-4025d59bde64)



Folder Structure:
```rust
--> packageName
    --> composer.json
    --> module.json
    --> src
        --> Config
        --> Console
        --> Database
        --> Events
        --> Http
            --> Controllers
                --> AbstractController // For rules and validations, extends in controllers
                --> PackageNameController
            --> Middleware
            --> Requests
        --> Jobs
        --> Listeners
        --> Models
        --> Providers
            --> ModuleServiceProvider
            --> RouteServiceProvider
        --> Resources
        --> routes
            --> V1.php
            --> web.php
        --> Test
```
 Like this above files and folder will create
  STEP 2:
      To register the package, follow the setup steps in "How to Setup MakePackager Module in Your Laravel Project" (Step 1 to Step 4)
      STEP 1:
      Create the packages folder and then move to MakePackager inside it
      STEP 2:
            Add the package namespace to composer.json file like below
            "Packages\\MakePackager\\": "packages/MakePackager/src" in autoload inside ps4 key.
             exmaple:  
               "autoload": {
                   "psr-4": {
                     "Packages\\MakePackager\\": "packages/MakePackager/src",
                   }
                 }
      STEP 3:
      laravel version below 10:
            Register the ServiceProvider package in the config/app.php file inside Providers:
            example:    
              'providers' => [
                Packages\MakePackager\Providers\MakePackagerServiceProvider::class,
              ]
       laravel version above 10:
            Register the ServiceProvider package in the app/Providers/AppServiceProvider file inside Providers:
            example:    
             public function register(): void
               {
                 $this->app->register(CustomPackageServiceProvider::class);
             }
      STEP 4:
            Initial setup is complete. Now, install the package by running the following commands:
```bash
             composer dump-autolod
             
             php artisan config:Cache
             php artisan config:clear
 ```
 
If you want to apply middleware authentication automatically, just add the `CustomRouteServiceProvider`. This will ensure that the middleware is added by default.

# MakePackager Artisan Commands

A few custom artisan commands to create specific packages:
 ```bash
 php artisan package:make-job YourFileName YourPackageName // to create jobs for a specific package
```
 ```bash
 php artisan package:make-migration YourFileName YourPackageName // to create migration files for a specific package
 ```
 ```bash
 php artisan package:make-listener YourFileName  YourPackageName // to create listeners for a specific package
 ```
 ```bash
 php artisan package:make-event YourFileName YourPackageName // to create events for a specific package
```

In the future, more artisan commands will be added.
This revision organizes the content into headings and adds formatting for better readability. If you need further adjustments, feel free to ask!
