<?php

declare(strict_types=1);

namespace Tests\Support\HttpClient;

use App\Adapters\HttpClient\HistoryMiddleware;
use Illuminate\Testing\Assert;

class AssertableRequestHistory
{
    public function __construct(
        private array $transactions
    ) {
    }

    public static function fromHistoryMiddleware(HistoryMiddleware $middleware): self
    {
        return new self($middleware->getTransactions());
    }

    public function assertRequestWasMade(RequestSpec $requestSpec): void
    {
        $sentRequests = array_map(function ($transaction): RequestSpec {
            $request = $transaction['request'];
            $options = $transaction['options'];

            return RequestSpec::fromRequest($request, $options);
        }, $this->transactions);

        Assert::assertThat($sentRequests, new ContainsRequest($requestSpec));
    }
}
