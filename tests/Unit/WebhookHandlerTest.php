<?php

declare(strict_types=1);

use App\DTOs\Webhook;
use App\Handlers\AppleWebhookHandler;
use App\Handlers\GoogleWebhookHandler;
use App\DTOs\Google\SubscriptionFactory;

test('supports', function(
    string $platform,
    bool $googleShouldBeHandled,
    bool $appleShouldHandled,
) {
    $mockFactory = Mockery::mock(SubscriptionFactory::class);

    $googleHandler = new GoogleWebhookHandler($mockFactory, []);
    $appleHandler = new AppleWebhookHandler();

    $webhook = new Webhook($platform, ['key' => 'value']);

    expect($googleHandler->supports($webhook))->toBe($googleShouldBeHandled);
    expect($appleHandler->supports($webhook))->toBe($appleShouldHandled);
})->with([
    ['google', true, false],
    ['apple', false, true],
    ['unknown', false, false],
]);

