<?php

declare(strict_types=1);

namespace Tests\System;

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

        // consumir evento
        $this->artisan('arquivei:tdd-talk:create-invoice', [
            '--max-messages' => 1,
            '--topic' => $topicName,
        ]);
    }
}
