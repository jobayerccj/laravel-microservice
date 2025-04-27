<?php

declare(strict_types=1);

namespace App\DTOs\Google;

use App\DTOs\Webhook;
use Carbon\CarbonImmutable;
use App\Models\SubscriptionEvent;
use App\DTOs\SubscriptionEventCategory;
use App\Exceptions\WebhookException;
use App\Repositories\SubscriptionEventRepository;

class SubscriptionFactory
{
    public function __construct(
        private readonly SubscriptionEventRepository $subscriptionEventRepository,
    ) {
    }
    public function create(Webhook $webhook)
    {
        try {
            $data = $webhook->getPayload();

            // Extract necessary fields from the webhook
            $subscriptionNotification = $data['data']['subscription_notification'];
            $developerNotification = $data['data']['developer_notification'];

            // Perform DB lookup to find matching event
            $subEvent = $this->subscriptionEventRepository->findByNotificationType(
                notificationType: $subscriptionNotification['notification_type'],
                inTrial: $subscriptionNotification['in_trial']
            );

            // Return a populated Subscription DTO
            return new Subscription(
                subscriptionId: $subscriptionNotification['subscription_id'],
                notificationType: $subscriptionNotification['notification_type'],
                inTrial: $subscriptionNotification['in_trial'],
                eventTime: CarbonImmutable::createFromTimestampMs($data['data']['event_time_millis']),
                event: $subEvent->name,
                category: $subEvent->category->value,
                productId: $developerNotification['product_id'],
                orderId: $developerNotification['order_id'],
                userId: $developerNotification['user_account_id'],
                email: $developerNotification['email'],
                autoRenewing: $developerNotification['auto_renewing'],
                purchaseDate: CarbonImmutable::createFromTimestampMs($developerNotification['purchase_time_millis']),
                expiryDate: CarbonImmutable::createFromTimestampMs($developerNotification['expiry_time_millis']),
                currency: $developerNotification['price_currency_code'],
                region: $developerNotification['region_code']
            );
        } catch(\Throwable $e) {
            throw new WebhookException(
                message: 'Failed to create subscription from webhook',
                code: 0,
                previous: $e
            );
        }
    }
}