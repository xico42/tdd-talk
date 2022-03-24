<?php

declare(strict_types=1);

namespace Tests\Support\Traits;

use Tests\Support\HttpClient\HttpClientWrapper;

trait HttpClient
{
    private HttpClientWrapper $httpclient;

    protected function setUpHttpClient(): void
    {
        $this->httpclient = $this->app->make(HttpClientWrapper::class);
    }
}
