<?php

namespace App\Providers;

use App\Adapters\Kafka\KafkaConfig;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(KafkaConfig::class, function () {
            $config = config('services');

            return new KafkaConfig(
                $config['kafka']['broker'],
                $config['kafka']['sasl']['username'],
                $config['kafka']['sasl']['password'],
                $config['kafka']['sasl']['mechanisms'],
                $config['kafka']['security_protocol'],
            );
        });
    }

    public function boot(): void
    {
    }
}
