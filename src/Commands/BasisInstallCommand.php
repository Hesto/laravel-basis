<?php

namespace Hesto\LaravelBasis\Commands;

use Hesto\Core\Commands\InstallAndReplaceCommand;
use Illuminate\Support\Facades\Artisan;
use SplFileInfo;
use Symfony\Component\Console\Input\InputOption;


class BasisInstallCommand extends InstallAndReplaceCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'basis:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install new Laravel 5.3 project';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        $this->setEnvFile();
        $this->composerRequire();
        $this->composerUpdate();
        $this->registerPackages();
        $this->installPackages();
        $this->migrateTables();

        return true;
    }

    private function setEnvFile()
    {

    }

    private function composerRequire()
    {
        Artisan::call('basis:dependencies', [
            'name' => $this->getParsedNameInput(),
            '--force' => true
        ]);
    }

    private function composerUpdate()
    {
        exec('php composer update');
    }

    private function registerPackages()
    {
        Artisan::call('basis:register');
    }

    private function installPackages()
    {
        $name = $this->getParsedNameInput();

        Artisan::call('vendor:publish');
        Artisan::call('make:auth');
        Artisan::call('rbac:migration');


        Artisan::call('multi-auth:install', [
            'name' => $this->getParsedNameInput(),
            '--force' => true
        ]);

        Artisan::call('multi-auth:layout', [
            'name' => $this->getParsedNameInput(),
            '--force' => true
        ]);

        Artisan::call('make:view', [
            'name' => $this->getParsedNameInput(),
            '--force' => true
        ]);

        Artisan::call('make:controller:template', [
            'name' => $this->getParsedNameInput() . 'Controller',
            '--force' => true
        ]);
    }

    private function migrateTables()
    {
        exec('php artisan migrate');
    }


}
