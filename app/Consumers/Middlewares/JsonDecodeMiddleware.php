<?php

declare(strict_types=1);

namespace App\Consumers\Middlewares;

class JsonDecodeMiddleware
{
    public function __invoke(string $rawMsg, callable $next): void
    {
        $decoded = json_decode($rawMsg, true);
        $next($decoded);
    }
}
