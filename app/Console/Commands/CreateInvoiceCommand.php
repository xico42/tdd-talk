<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Adapters\HttpClient\Client;
use Illuminate\Console\Command;
use Kafka\Consumer\ConsumerBuilder;

class CreateInvoiceCommand extends Command
{
    protected $signature = 'arquivei:tdd-talk:create-invoice {--max-messages} {--topic}';

    public function __invoke(Client $httpClient): void
    {
        $topic = $this->option('topic');
        $maxMessages = intval($this->option('max-messages'));
        $groupId = 'com.arquivei.core.tdd-talk';

        $kafkaConsumer = ConsumerBuilder::create('kafka:9092', $groupId, [$topic])
            ->withMiddleware(function (string $rawMsg, callable $next): void {
                $decoded = json_decode($rawMsg, true);
                $next($decoded);
            })
            ->withMaxMessages($maxMessages)
            ->withHandler(function (array $rawData) use ($httpClient) {
                $httpClient->request('POST', 'SalesTaxInvoices', [
                    'json' => [
                        'Value' => $rawData['value'],
                    ],
                ]);
            })
            ->build();

        $kafkaConsumer->consume();
    }
}
