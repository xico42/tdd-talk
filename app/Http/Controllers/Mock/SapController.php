<?php

declare(strict_types=1);

namespace App\Http\Controllers\Mock;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SapController extends Controller
{
    public function createInvoice(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
