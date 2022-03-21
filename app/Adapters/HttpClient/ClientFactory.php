<?php

declare(strict_types=1);

namespace App\Adapters\HttpClient;

use Arquivei\LaravelPrometheusExporter\GuzzleMiddleware;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;

class ClientFactory
{
    private const DEFAULT_TIMEOUT_SECONDS = 5.0;

    public function make(array $config = [], callable ...$middlewares): Client
    {
        $handler = HandlerStack::create(new CurlHandler());

        foreach ($middlewares as $middleware) {
            $handler->push($middleware);
        }

        $config['handler'] = $handler;
        $config['timeout'] ??= self::DEFAULT_TIMEOUT_SECONDS;

        return new GuzzleClient(
            new Guzzle($config),
        );
    }
}
