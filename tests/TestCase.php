<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Tests\Support\Traits\KafkaServer;

class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUpTraits(): array
    {
        $uses = parent::setUpTraits();

        if (isset($uses[KafkaServer::class])) {
            $this->setUpKafka();
        }

        return $uses;
    }
}
