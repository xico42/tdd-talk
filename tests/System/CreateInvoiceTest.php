<?php

declare(strict_types=1);

namespace Tests\System;

use App\Adapters\HttpClient\Client;
use App\Adapters\HttpClient\ClientFactory;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Tests\Support\Traits\KafkaServer;
use Tests\TestCase;

class CreateInvoiceTest extends TestCase
{
    use KafkaServer;

    public function testShouldCreateInvoiceInSAP(): void
    {
        $invoiceData = [
            'value' => 4200.42,
        ];

        $topicName = 'com.arquivei.events.nfse-was-emitted' . uniqid();

        $this->kafkaServer->sendMessage($topicName, json_encode($invoiceData));

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
            $invoiceData = json_decode($request->getBody()->getContents(), true);
            $sentValue = $invoiceData['Value'] ?? null;

            if (
                $request->getUri()->__toString() === 'http://nginx/mock/sap/SalesTaxInvoices'
                && $request->getMethod() === 'POST'
                && $sentValue === $invoiceData['value']
            ) {
                $foundValidRequest = true;
                break;
            }
        }

        $this->assertTrue($foundValidRequest, "No http request matching the expected was sent to SAP");
    }
}
