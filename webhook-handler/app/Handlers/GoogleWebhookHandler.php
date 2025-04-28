<?php

declare(strict_types=1);

namespace App\Handlers;


use App\DTOs\Webhook;
use App\Contracts\WebhookHandler;
use Illuminate\Support\Facades\Log;
use App\DTOs\Google\SubscriptionFactory;
use App\Contracts\GoogleSubscriptionForwarder;

class GoogleWebhookHandler implements WebhookHandler
{
    private const string SUPPORTED_PLATFORM = 'google';

    /**
     * @param SubscriptionFactory $subscriptionFactory
     * @param iterable<GoogleSubscriptionForwarder> $forwarders
     */
    public function __construct(
        private SubscriptionFactory $subscriptionFactory,
        private iterable $forwarders,
        ) {
        }

    public function supports(Webhook $webhook): bool
    {
        return strtolower($webhook->getPlatform()) === self::SUPPORTED_PLATFORM;
    }

    public function handle(Webhook $webhook): void
    {
        Log::info('Google Webhook received', ['payload' => $webhook->getPayload()]);
        $subscripton = $this->subscriptionFactory->create($webhook);

        foreach($this->forwarders as $forwarder) {
            if ($forwarder->supports($subscripton)) {
                $forwarder->forward($subscripton);
            }
        }
    }
    
}
