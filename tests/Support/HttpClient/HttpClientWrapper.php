<?php

declare(strict_types=1);

namespace Tests\Support\HttpClient;

use App\Adapters\HttpClient\HistoryMiddleware;

class HttpClientWrapper
{
    public function __construct(
        private HistoryMiddleware $historyMiddleware,
    ) {
    }

    public function assertRequestWasMade(RequestSpec $requestSpec): void
    {
        AssertableRequestHistory::fromHistoryMiddleware($this->historyMiddleware)
            ->assertRequestWasMade($requestSpec);
    }
}
