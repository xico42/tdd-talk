<?php

declare(strict_types=1);

namespace App\Adapters\Kafka;

class KafkaConfig
{
    public function __construct(
        private string $broker,
        private string $username,
        private string $password,
        private string $mechanisms,
        private string $securityProtocol,
    ) {
    }

    public function getBroker(): string
    {
        return $this->broker;
    }

    public function getMechanisms(): string
    {
        return $this->mechanisms;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSecurityProtocol(): string
    {
        return $this->securityProtocol;
    }
}
