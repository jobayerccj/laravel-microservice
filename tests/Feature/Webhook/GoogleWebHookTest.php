<?php

declare(strict_types=1);

use function Pest\Laravel\postJson;

use App\Models\SubscriptionEvent;
use Illuminate\Support\Facades\Http;

it('the google webhook endpoint works', function () {
    $payload = getPayload();

    $response = postJson('/api/webhook', $payload, ['X-Webhook-Source' => 'google']);

    $response->assertStatus(204);
});

it('processes subscription purchase notification', function () {
    $payload = getPayload();
    $subscriptionEvents = SubscriptionEvent::all(); 
    //dd($subscriptionEvents);

    Http::fake();

    $response = postJson('/api/webhook', $payload, ['X-Webhook-Source' => 'google']);

    Http::assertSentCount(1);

    $response->assertStatus(204);
});

function getPayload(
    int $notificationType = 4,
    bool $inTrial = false,
    bool $autoRenewing = true
): array
{
    return [
        "data" => [
            "version" => "1.0",
            "package_name" => "com.example.premium",
            "event_time_millis" => "1704567890123",
            "subscription_notification" => [
                "notification_type" => $notificationType,
                "purchase_token" => "abcd1234-5678-efgh-9101-ijklmnopqrst",
                "subscription_id" => "premium_monthly",
                "in_trial" => $inTrial
            ],
            "developer_notification" => [
                "order_id" => "GPA.1234-5678-9012-34567",
                "product_id" => "premium_monthly",
                "user_account_id" => "USER-001",
                "email" => "joe@example.com",
                "acknowledgement_state" => 1,
                "auto_renewing" => $autoRenewing,
                "purchase_state" => 0,
                "purchase_time_millis" => "1704567890123",
                "expiry_time_millis" => "1707567890123",
                "price_amount_micros" => "4990000",
                "price_currency_code" => "USD",
                "region_code" => "US"
            ]
        ],
        "message_id" => "1234567890123456",
        "publish_time" => "2024-01-05T12:00:00.000Z"
    ];
}