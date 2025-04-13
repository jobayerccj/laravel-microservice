<?php

declare(strict_types=1);

namespace App\Handlers;

use App\DTOs\Webhook;
use App\Contracts\WebhookHandler;

readonly class HandlerDeligator
{
    /**
     * @param iterable<WebhookHandler> $handlers
     */
    public function __construct(
        private iterable $handlers,
    ) {
    }

    public function delegate(Webhook $webhook): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler->supports($webhook)) {
                $handler->handle($webhook);
            }
        }
    }

}