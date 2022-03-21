<?php

declare(strict_types=1);

namespace App\Adapters\HttpClient;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

interface Client
{
    /**
     * @throws GuzzleException
     */
    public function request(string $method, string $uri, array $options = []): ResponseInterface;
}
