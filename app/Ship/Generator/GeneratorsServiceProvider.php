<?php

namespace App\Ship\Generator;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerGenerators([
            'Action',
            'Controller',
            'Exception',
            'Model',
            'Repository',
            'Request',
            'Route',
            'Task',
            'Transformer'
        ]);
    }

    /**
     * Register the generators.
     * @param array $classes
     */
    private function registerGenerators(array $classes)
    {
        foreach ($classes as $class) {
            $lowerClass = strtolower($class);

            $this->app->singleton("command.porto.$lowerClass", function ($app) use ($class) {
                return $app['App\Ship\Generator\Commands\\' . $class . 'Generator'];
            });

            $this->commands("command.porto.$lowerClass");
        }
    }
}
