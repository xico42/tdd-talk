<?php

namespace App\Providers;

use App\Adapters\HttpClient\Client;
use App\Adapters\HttpClient\ClientFactory;
use App\Adapters\HttpClient\HistoryMiddleware;
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

        if ($this->app->environment('testing')) {
            $this->app->singleton(HistoryMiddleware::class, fn() => new HistoryMiddleware());
            $this->app->tag([HistoryMiddleware::class], 'http-middleware');
        }

        $this->app->bind(Client::class, function () {
            $middlewares = $this->app->tagged('http-middleware');

            return $this->app->make(ClientFactory::class)
                ->make([
                    'base_uri' => env('SAP_BASE_URI'),
                ], ...$middlewares);
        });
    }

    public function boot(): void
    {
    }
}
