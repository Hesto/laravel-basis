<?php

namespace Hesto\LaravelBasis\Commands;

use Hesto\Core\Commands\InstallAndReplaceCommand;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputArgument;


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
    protected $description = 'Install packages';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        $this->installPackages();

        return true;
    }

    private function installPackages()
    {
        $name = $this->getParsedNameInput();

        $this->call('vendor:publish');
        $this->call('make:auth');
        $this->call('rbac:migration');


        $this->call('multi-auth:install', [
            'name' => $name,
            '--force' => true
        ]);

        $this->call('adminlte:install', [
            '--force' => true
        ]);

        $this->call('adminlte:layout', [
            'name' => $name,
            '--force' => true
        ]);

        $this->call('make:view', [
            'name' => $name,
            '--force' => true
        ]);

        $this->call('make:controller:template', [
            'name' => ucfirst($name) . 'Controller',
            '--force' => true
        ]);
    }


}
