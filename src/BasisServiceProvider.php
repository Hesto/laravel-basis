<?php

namespace Hesto\LaravelBasis;

use Illuminate\Support\ServiceProvider;

class BasisServiceProvider extends ServiceProvider
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
        $this->registerInstallCommand();
        $this->registerAuthSettingsInstallCommand();
        $this->registerAuthFilesInstallCommand();
    }

    /**
     * Register the adminlte:install command.
     */
    private function registerInstallCommand()
    {
        $this->app->singleton('command.hesto.laravel-basis.install', function ($app) {
            return $app['Hesto\MultiAuth\Commands\BasisInstallCommand'];
        });

        $this->commands('command.hesto.laravel-basis.install');
    }

    /**
     * Register the adminlte:install command.
     */
    private function registerAuthSettingsInstallCommand()
    {
        $this->app->singleton('command.hesto.laravel-basis.dependencies', function ($app) {
            return $app['Hesto\MultiAuth\Commands\BasisDependenciesInstallCommand'];
        });

        $this->commands('command.hesto.laravel-basis.dependencies');
    }

    /**
     * Register the adminlte:install command.
     */
    private function registerAuthFilesInstallCommand()
    {
        $this->app->singleton('command.hesto.laravel-basis.register', function ($app) {
            return $app['Hesto\MultiAuth\Commands\BasisPackagesRegisterCommand'];
        });

        $this->commands('command.hesto.laravel-basis.register');
    }

}
