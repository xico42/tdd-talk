<?php

declare(strict_types=1);

namespace Tests\Support\Traits;

use Tests\Support\KafkaWrapper;

trait KafkaServer
{
    protected KafkaWrapper $kafkaServer;

    protected function setUpKafka(): void
    {
        $this->kafkaServer = $this->app->make(KafkaWrapper::class);
    }
}
