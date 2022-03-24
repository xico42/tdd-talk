<?php

declare(strict_types=1);

namespace App\Adapters\HttpClient;

use Closure;
use GuzzleHttp\Middleware;

class HistoryMiddleware
{
    private array $transactions = [];
    private Closure $innerMiddleware;

    public function __construct()
    {
        $this->innerMiddleware = Middleware::history($this->transactions);
    }

    public function __invoke(callable $handler): callable
    {
        return call_user_func($this->innerMiddleware, $handler);
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
