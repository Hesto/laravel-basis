<?php

namespace Hesto\LaravelBasis\Commands;

use Hesto\Core\Commands\InstallContentCommand;
use Symfony\Component\Console\Input\InputOption;


class BasisPackagesRegisterCommand extends InstallContentCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'basis:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register packages in app.php and AppServiceProvider.php';

    /**
     * Get the destination path.
     *
     * @return string
     */
    public function getSettings()
    {
        $framework = $this->getFrameworkInput();

        return [
            'method' => [
                'path' => '/app/Providers/AppServiceProvider.php',
                'search' => "public function register()\n    {",
                'stub' => __DIR__ . '/../stubs/Providers/' . $framework . '/AppServiceProviderMethod.stub',
                'prefix' => false,
            ],
            'providers' => [
                'path' => '/app/Providers/AppServiceProvider.php',
                'search' => 'if ($this->app->environment() == "local") {',
                'stub' => __DIR__ . '/../stubs/Providers/' . $framework . '/AppServiceProviderProviders.stub',
                'prefix' => false,
            ],
            'providersConfig' => [
                'path' => '/config/app.php',
                'search' => "* Package Service Providers...\n         */",
                'stub' => __DIR__ . '/../stubs/config/' . $framework . '/appProviders.stub',
                'prefix' => false,
            ],
            'facadesConfig' => [
                'path' => '/config/app.php',
                'search' => "'aliases' => [",
                'stub' => __DIR__ . '/../stubs/config/' . $framework . '/appFacades.stub',
                'prefix' => false,
            ],
        ];
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
