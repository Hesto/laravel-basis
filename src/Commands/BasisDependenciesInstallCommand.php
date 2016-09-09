<?php

namespace Hesto\LaravelBasis\Commands;

use Hesto\Core\Commands\InstallContentCommand;
use Symfony\Component\Console\Input\InputOption;


class BasisDependenciesInstallCommand extends InstallContentCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'basis:dependencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy dependencies to composer.json file';

    /**
     * Get the destination path.
     *
     * @return string
     */
    public function getSettings()
    {
        return [
            'require' => [
                'path' => '/composer.json',
                'search' => '"require": {',
                'stub' => __DIR__ . '/../stubs/composer/require.stub',
                'prefix' => false,
            ],
            'requireDev' => [
                'path' => '/composer.json',
                'search' => '"require-dev": {',
                'stub' => __DIR__ . '/../stubs/composer/require.dev.stub',
                'prefix' => false,
            ],
        ];
    }
}
