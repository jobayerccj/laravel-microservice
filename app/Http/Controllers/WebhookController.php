<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\Webhook;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class WebhookController
{
    public function __invoke(Request $request): JsonResponse
    {
        $platform = $request->header('X-Webhook-Source', 'unknown');
        $payload = $request->all();
        $webhook = new Webhook($platform, $payload);


        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
