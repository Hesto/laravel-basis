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
        $this->registerBasisDependenciesCommand();
        $this->registerBasisRegiserCommand();
        $this->registerBasisEnvCommand();
    }

    /**
     * Register the basis:install command.
     */
    private function registerInstallCommand()
    {
        $this->app->singleton('command.hesto.laravel-basis.install', function ($app) {
            return $app['Hesto\LaravelBasis\Commands\BasisInstallCommand'];
        });

        $this->commands('command.hesto.laravel-basis.install');
    }

    /**
     * Register the basis:install command.
     */
    private function registerBasisDependenciesCommand()
    {
        $this->app->singleton('command.hesto.laravel-basis.dependencies', function ($app) {
            return $app['Hesto\LaravelBasis\Commands\BasisDependenciesInstallCommand'];
        });

        $this->commands('command.hesto.laravel-basis.dependencies');
    }

    /**
     * Register the basis:install command.
     */
    private function registerBasisRegiserCommand()
    {
        $this->app->singleton('command.hesto.laravel-basis.register', function ($app) {
            return $app['Hesto\LaravelBasis\Commands\BasisPackagesRegisterCommand'];
        });

        $this->commands('command.hesto.laravel-basis.register');
    }

    /**
     * Register the basis:install command.
     */
    private function registerBasisEnvCommand()
    {
        $this->app->singleton('command.hesto.laravel-basis.env', function ($app) {
            return $app['Hesto\LaravelBasis\Commands\BasisEnvInstallCommand'];
        });

        $this->commands('command.hesto.laravel-basis.env');
    }

}
