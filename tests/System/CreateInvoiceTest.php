<?php

declare(strict_types=1);

namespace Tests\System;

use App\Adapters\HttpClient\Client;
use App\Adapters\HttpClient\ClientFactory;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Tests\TestCase;

class CreateInvoiceTest extends TestCase
{
    public function testShouldCreateInvoiceInSAP(): void
    {
        $data = [
            'value' => 4200.42,
        ];

        $topicName = 'com.arquivei.events.nfse-was-emitted' . uniqid();

        // Enviar um evento
        $rdKafkaConf = new \RdKafka\Conf();
        $rdKafkaConf->set('security.protocol', 'PLAINTEXT');
        $rdKafkaConf->set('sasl.mechanisms', 'PLAIN');
        $rdKafkaConf->set('bootstrap.servers', 'kafka:9092');

        $producer = new \RdKafka\Producer($rdKafkaConf);

        $topic = $producer->newTopic($topicName);
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode($data));

        $producer->flush(12000);

        $container = [];
        $historyMiddleware = Middleware::history($container);

        $httpClient = (new ClientFactory())
            ->make([
                'base_uri' => 'http://nginx/mock/sap/',
            ], $historyMiddleware);

        $this->instance(Client::class, $httpClient);

        // consumir evento
        $this->artisan('arquivei:tdd-talk:create-invoice', [
            '--max-messages' => 1,
            '--topic' => $topicName,
        ]);

        $foundValidRequest = false;
        foreach ($container as $transaction) {
            /** @var RequestInterface $request */
            $request = $transaction['request'];

            $request->getBody()->rewind();
            $data = json_decode($request->getBody()->getContents(), true);
            $sentValue = $data['Value'] ?? null;

            if (
                $request->getUri()->__toString() === 'http://nginx/mock/sap/SalesTaxInvoices'
                && $request->getMethod() === 'POST'
                && $sentValue === $data['Value']
            ) {
                $foundValidRequest = true;
                break;
            }
        }

        $this->assertTrue($foundValidRequest, "No http request matching the expected was sent to SAP");
    }
}
