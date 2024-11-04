<?php

namespace Packages\MakePackager\Commands;

use Illuminate\Support\Str;
use Packages\MakePackager\Support\Config\GenerateConfigReader;
use Packages\MakePackager\Support\Stub;
use Packages\MakePackager\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class TestMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    protected $argumentName = 'name';

    protected $name = 'package:make-test';

    protected $description = 'Create a new test class for the specified module.';

    public function getDefaultNamespace(): string
    {
        if ($this->option('feature')) {
            return config('modules.paths.generator.test-feature.namespace')
                ?? config('modules.paths.generator.test-feature.path', 'Tests/Feature');
        }

        return config('modules.paths.generator.test-unit.namespace')
            ?? config('modules.paths.generator.test-unit.path', 'Tests/Unit');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the form request class.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],

        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['feature', null, InputOption::VALUE_NONE, 'Create a feature test.'],
        ];
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());
        $stub = '/unit-test.stub';

        if ($this->option('feature')) {
            $stub = '/feature-test.stub';
        }

        return (new Stub($stub, [
            'NAMESPACE' => $this->getClassNamespace($module),
            'CLASS' => $this->getClass(),
        ]))->render();
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        if ($this->option('feature')) {
            $testPath = GenerateConfigReader::read('test-feature');
        } else {
            $testPath = GenerateConfigReader::read('test-unit');
        }

        return $path.$testPath->getPath().'/'.$this->getFileName().'.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name'));
    }

    /* Get the module name.
    *
    * @return string
    */
   public function getModuleName()
   {
       $module = $this->argument('module') ?: app('modules')->getUsedNow();

       $module = app('modules')->findOrFail($module);

       return $module->getStudlyName();
   }
}
