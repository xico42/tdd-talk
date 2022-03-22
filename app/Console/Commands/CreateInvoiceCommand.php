<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateInvoiceCommand extends Command
{
    protected $signature = 'arquivei:tdd-talk:create-invoice {--max-messages} {--topic}';

    public function __invoke(): void
    {
    }
}
