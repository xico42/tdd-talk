<?php

declare(strict_types=1);

namespace App\Consumers\Handlers;

use App\Adapters\HttpClient\Client;

class CreateInvoiceHandler
{
    public function __construct(
        private Client $httpClient,
    ) {
    }

    public function __invoke(array $invoiceData): void
    {
        $this->httpClient->request('POST', 'SalesTaxInvoices', [
            'json' => [
                'Value' => $invoiceData['value'],
            ],
        ]);
    }
}
