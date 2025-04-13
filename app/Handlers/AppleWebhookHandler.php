<?php

declare(strict_types=1);

namespace App\Handlers;


use App\DTOs\Webhook;
use App\Contracts\WebhookHandler;
use Illuminate\Support\Facades\Log;

class AppleWebhookHandler implements WebhookHandler
{
    private const string SUPPORTED_PLATFORM = 'apple';

    public function handle(Webhook $webhook): void
    {
        Log::info('Google Webhook received', ['payload' => $webhook->getPayload()]);
    }

    public function supports(Webhook $webhook): bool
    {
        return strtolower($webhook->getPlatform()) === self::SUPPORTED_PLATFORM;
    }
}
