<?php

declare(strict_types=1);

namespace App\Adapters\HttpClient;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class GuzzleClient implements Client
{
    public function __construct(
        private Guzzle $guzzle,
    ) {
    }

    public function request(string $method, string $uri, array $options = []): ResponseInterface
    {
        return $this->guzzle->request($method, $uri, $options);
    }
}
