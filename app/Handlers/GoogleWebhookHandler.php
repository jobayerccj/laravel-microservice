<?php

declare(strict_types=1);

namespace App\Handlers;


use App\DTOs\Webhook;
use App\Contracts\WebhookHandler;
use App\DTOs\Google\SubscriptionFactory;
use Illuminate\Support\Facades\Log;

class GoogleWebhookHandler implements WebhookHandler
{
    private const string SUPPORTED_PLATFORM = 'google';

    public function __construct(private SubscriptionFactory $subscriptionFactory)
    {
        // You can inject dependencies here if needed
    }
    public function supports(Webhook $webhook): bool
    {
        return strtolower($webhook->getPlatform()) === self::SUPPORTED_PLATFORM;
    }

    public function handle(Webhook $webhook): void
    {
        // Handle the Google webhook here
        // For example, you can log the payload or process it as needed
        //Log::info('Google Webhook received', ['payload' => $webhook->getPayload()]);
        $subscripton = $this->subscriptionFactory->create($webhook);

        dd($subscripton);
    }
    
}
