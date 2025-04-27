<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\Webhook;
use Illuminate\Http\Request;
use App\Contracts\ErrorHandler;
use Illuminate\Http\JsonResponse;
use App\Handlers\HandlerDeligator;
use App\Exceptions\WebhookException;
use Symfony\Component\HttpFoundation\Response;

class WebhookController
{
    public function __construct(
        private readonly HandlerDeligator $handlerDeligator,
        private readonly ErrorHandler $errorHandler,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $platform = strtolower($request->header('X-Webhook-Source', 'unknown'));
        $payload = $request->all();

        try{
            $webhook = new Webhook($platform, $payload);
            $this->handlerDeligator->delegate($webhook);
            return new JsonResponse(status: Response::HTTP_NO_CONTENT);
        }catch(\Throwable $throwable){
            $this->errorHandler->handle($throwable);

            $status = $throwable instanceof WebhookException
                ? Response::HTTP_BAD_REQUEST
                : Response::HTTP_INTERNAL_SERVER_ERROR;
            return new JsonResponse(status: $status);
        }
    }
}
