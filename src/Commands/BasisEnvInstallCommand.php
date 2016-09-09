<?php

namespace Hesto\LaravelBasis\Commands;

use Hesto\Core\Commands\SimpleReplaceContentCommand;
use Symfony\Component\Console\Input\InputOption;


class BasisEnvInstallCommand extends SimpleReplaceContentCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'basis:env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup .env file';

    /**
     * Get the destination path.
     *
     * @return string
     */
    public function getSettings()
    {
        $db = $this->ask('What is your db name?');
        $username = $this->ask('What is your db username?');
        $password = $this->ask('What is your db password?');

        return [
            'db' => [
                'path' => '/.env',
                'search' => 'DB_DATABASE=homestead',
                'replace' => 'DB_DATABASE=' . $db,
            ],
            'username' => [
                'path' => '/.env',
                'search' => 'DB_USERNAME=homestead',
                'replace' => 'DB_USERNAME=' . $username,
            ],
            'password' => [
                'path' => '/.env',
                'search' => 'DB_PASSWORD=secret',
                'replace' => 'DB_PASSWORD=' . $password,
            ],
        ];
    }
}
