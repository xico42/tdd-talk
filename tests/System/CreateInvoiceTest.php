<?php

declare(strict_types=1);

namespace Tests\System;

use Tests\Support\HttpClient\RequestSpec;
use Tests\Support\Traits\HttpClient;
use Tests\Support\Traits\KafkaServer;
use Tests\TestCase;

class CreateInvoiceTest extends TestCase
{
    use KafkaServer;
    use HttpClient;

    public function testShouldCreateInvoiceInSAP(): void
    {
        $invoiceData = [
            'value' => 4200.42,
        ];

        $topicName = 'com.arquivei.events.nfse-was-emitted' . uniqid();

        $this->kafkaServer->sendMessage($topicName, json_encode($invoiceData));

        // consumir evento
        $this->artisan('arquivei:tdd-talk:create-invoice', [
            '--max-messages' => 1,
            '--topic' => $topicName,
        ]);

        $this->httpclient->assertRequestWasMade(
            RequestSpec::aRequest()
                ->withUri('SalesTaxInvoices')
                ->withMethod('POST')
                ->withData([
                    'Value' => $invoiceData['value'],
                ])
        );
    }
}
