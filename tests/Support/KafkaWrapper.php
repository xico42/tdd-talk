<?php

declare(strict_types=1);

namespace Tests\Support;

use App\Adapters\Kafka\KafkaConfig;
use App\Consumers\Middlewares\JsonDecodeMiddleware;
use Kafka\Consumer\ConsumerBuilder;
use Kafka\Consumer\Entities\Config\Sasl;
use Kafka\Consumer\Exceptions\KafkaConsumerException;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\TraversableContainsEqual;

class KafkaWrapper
{
    public function __construct(
        private KafkaConfig $config
    ) {
    }

    public function sendMessage(string $topicName, string $msg): self
    {
        $rdKafkaConf = new \RdKafka\Conf();
        $rdKafkaConf->set('security.protocol', $this->config->getSecurityProtocol());
        $rdKafkaConf->set('sasl.mechanisms', $this->config->getMechanisms());
        $rdKafkaConf->set('bootstrap.servers', $this->config->getBroker());

        $producer = new \RdKafka\Producer($rdKafkaConf);

        $topic = $producer->newTopic($topicName);
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, $msg);

        if (method_exists($producer, 'flush')) {
            $producer->flush(12000);
        }

        return $this;
    }
}
