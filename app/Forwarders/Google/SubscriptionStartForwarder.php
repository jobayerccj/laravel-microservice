<?php

declare(strict_types=1);

namespace App\Forwarders\Google;

use App\DTOs\Google\Subscription;
use App\DTOs\SubscriptionEventCategory;
use App\Contracts\GoogleSubscriptionForwarder;

class SubscriptionStartForwarder implements GoogleSubscriptionForwarder
{
    public function supports(Subscription $subscription): bool
    {
        return $subscription->category === SubscriptionEventCategory::START->value;
    }

    public function forward(Subscription $subscription): void
    {
        // Logic to forward the subscription start event to Google
        // This is a placeholder implementation
        dd('forwarer', $subscription);
    }
}