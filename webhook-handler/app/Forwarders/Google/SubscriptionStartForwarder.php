<?php

declare(strict_types=1);

namespace App\Forwarders\Google;

use App\Clients\AudienceGridClient;
use App\DTOs\Google\Subscription as GoogleSubscription;
use App\DTOs\SubscriptionEventCategory;
use App\Contracts\GoogleSubscriptionForwarder;
use App\DTOs\AudienceGrid\Subscription as AudienceGridSubscription;
use App\Mappers\Google\SubscriptionMapper;
use App\Validators\SubscriptionValidator;

class SubscriptionStartForwarder implements GoogleSubscriptionForwarder
{
    public function __construct(
        private SubscriptionValidator $validator,
        private AudienceGridClient $audienceGridClient,
    ) {
    }

    public function supports(GoogleSubscription $subscription): bool
    {
        return $subscription->category === SubscriptionEventCategory::START->value;
    }

    public function forward(GoogleSubscription $subscription): void
    {
       $audienceGridSubscription = (new SubscriptionMapper())->mapToAudienceGrid($subscription);

       $this->validator->validate($audienceGridSubscription, AudienceGridSubscription::rules());
    
       $this->audienceGridClient->post($audienceGridSubscription->toArray());
    }
}