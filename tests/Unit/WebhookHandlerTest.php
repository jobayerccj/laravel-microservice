<?php

declare(strict_types=1);

use App\Handlers\AppleWebhookHandler;
use App\Handlers\GoogleWebhookHandler;

test('supports', function(
    string $platform,
    bool $googleShouldBeHandled,
    bool $appleShouldHandled,
) {
    $googleHandler = new GoogleWebhookHandler();
    $appleHandler = new AppleWebhookHandler();

    $webhook = new \App\DTOs\Webhook($platform, ['key' => 'value']);

    expect($googleHandler->supports($webhook))->toBe($googleShouldBeHandled);
    expect($appleHandler->supports($webhook))->toBe($appleShouldHandled);
})->with([
    ['google', true, false],
    ['apple', false, true],
    ['unknown', false, false],
]);

