<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Adapters\Kafka\KafkaConfig;
use App\Consumers\Handlers\CreateInvoiceHandler;
use App\Consumers\Middlewares\JsonDecodeMiddleware;
use Illuminate\Console\Command;
use Kafka\Consumer\ConsumerBuilder;
use Kafka\Consumer\Entities\Config\Sasl;

class CreateInvoiceCommand extends Command
{
    protected $signature = 'arquivei:tdd-talk:create-invoice {--max-messages} {--topic}';

    public function __invoke(CreateInvoiceHandler $handler, KafkaConfig $kafkaConfig): void
    {
        $topic = $this->option('topic');
        $maxMessages = intval($this->option('max-messages'));
        $groupId = 'com.arquivei.core.tdd-talk';

        $kafkaConsumer = ConsumerBuilder::create($kafkaConfig->getBroker(), $groupId, [$topic])
            ->withMaxMessages($maxMessages)
            ->withDlq()
            ->withSecurityProtocol($kafkaConfig->getSecurityProtocol())
            ->withSasl(
                new Sasl(
                    $kafkaConfig->getUsername(),
                    $kafkaConfig->getPassword(),
                    $kafkaConfig->getMechanisms(),
                ),
            )
            ->withMiddleware(new JsonDecodeMiddleware())
            ->withHandler($handler)
            ->build();

        $kafkaConsumer->consume();
    }
}
