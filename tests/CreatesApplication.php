<?php

namespace Tests;

use Exception;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        /** @var Application $app */
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->loadEnvironmentFrom('.env.integration');

        if (
            basename($app->environmentFilePath()) !== '.env.integration'
            || !is_readable($app->environmentFilePath())
        ) {
            throw new Exception('Missing .env.integration file');
        }

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
