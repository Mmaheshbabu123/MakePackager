/********************Welcome to custom packager module***********************************/
#HOW TO SETUP MakePackager Module in your laravel Project
STEP 1: composer require ifo/laravel-make-packager
STEP 2: composer dump-Autoload
successfully package installed
#How to Create a Custom Package
STEP 1:
      Run the following command:
      php artisan package:make Your pakage name
      This command will create the folder structure and necessary files for your package, including routes, ServiceProvider, and an AbstractController for enforcing rules and validations.

Folder Structure:
       --->packageName
           -->composer.json
           -->module.json
           -->src
              -->Config
              -->Console
              -->Database
              -->EventS
              -->Http
                 -->Controllers
                   -->AbstractController // for rules and validations extends in controoler
                   -->PackageNameController
                 -->Middleware
                 -->Requests
              -->Jobs
              -->Listeners
              -->Models
              -->Providers
              -->Resources
              -->routes
              -->Test

    Like this above files and folder will create
  STEP 2:
      To register the package, follow the setup steps in "How to Setup MakePackager Module in Your Laravel Project" (Step 1 to Step 4).
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
            Register the ServiceProvider package in the config/app.php file inside Providers:
            example:    
              'providers' => [
                Packages\MakePackager\Providers\MakePackagerServiceProvider::class,
              ]
      STEP 4:
            Initial setup is complete. Now, install the package by running the following commands:
            composer dump-autolod
            php artisan config:Cache
            php artisan config:clear
  In Additinally Middleware authincations also will done automaticallly no need to regsister in Routes servericeProvider file
   like below
         Route::middleware('lienionauth.api')
         ->namespace($this->moduleGoLiveNameSpace)
         ->group(base_path('packages/Projects/GoLive/src/routes/api.php'));
you have to define which authnicate middleware register for package in config file
file path: packages/MakePackager/src/config/config.php
'namespace' => 'Packages',
'middleware'=>'lienionauth.api',


#MakePackager Artisan Commands
A few custom artisan commands to create specific packages:

 php artisan package:make-jobs YourPackageName // to create jobs for a specific package
 php artisan package:make-migration YourPackageName // to create migration files for a specific package
 php artisan package:make-listener YourPackageName // to create listeners for a specific package
 php artisan package:make-event YourPackageName // to create events for a specific package

In the future, more artisan commands will be added.
This revision organizes the content into headings and adds formatting for better readability. If you need further adjustments, feel free to ask!
