<?php

namespace Hesto\LaravelBasis\Commands;

use Hesto\Core\Commands\InstallAndReplaceCommand;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputArgument;
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

        if($this->getFrameworkInput() == 'adminlte') {
            $this->call('adminlte:install', [
                '--force' => true
            ]);

            $this->call('adminlte:layout', [
                'name' => $name,
                '--force' => true
            ]);
        }

        if($this->getFrameworkInput() == 'bulma') {
            $this->call('bulma:install', [
                '--force' => true
            ]);
        }

        $this->call('make:view', [
            'name' => $name,
            '--force' => true
        ]);

        $this->call('make:controller:template', [
            'name' => ucfirst($name) . 'Controller',
            '--force' => true
        ]);
    }

    /**
     * @return mixed
     */
    public function getFrameworkInput()
    {
        return $this->option('framework');
    }

    public function getOptions()
    {
        return [
            ['framework', null, InputOption::VALUE_OPTIONAL, 'CSS framework', 'bulma'],
            ['force', 'f', InputOption::VALUE_NONE, 'Force override existing files'],
        ];
    }
}
