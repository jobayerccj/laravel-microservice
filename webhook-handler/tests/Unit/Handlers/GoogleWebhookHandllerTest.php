<?php

declare(strict_types=1);

namespace Tests\Unit\Handlers;

use Mockery;
use App\DTOs\Webhook;
use App\Handlers\GoogleWebhookHandler;
use App\DTOs\Google\SubscriptionFactory;
use App\Contracts\GoogleSubscriptionForwarder;

it('returns true for supported webhooks', function () {
    $subscriptionFactoryMock = Mockery::mock(SubscriptionFactory::class);
    $forwarderMock = Mockery::mock(GoogleSubscriptionForwarder::class);

    $handler = new GoogleWebhookHandler($subscriptionFactoryMock, [$forwarderMock]);
    $webhook = new Webhook('google', ['key' => 'value']);
    expect($handler->supports($webhook))->toBeTrue();
});

it('returns false for unsupported webhooks', function () {
    $subscriptionFactoryMock = Mockery::mock(SubscriptionFactory::class);
    $forwarderMock = Mockery::mock(GoogleSubscriptionForwarder::class);

    $handler = new GoogleWebhookHandler($subscriptionFactoryMock, [$forwarderMock]);
    $webhook = new Webhook('apple', ['key' => 'value']);
    expect($handler->supports($webhook))->toBeFalse();
});


it('process webhooks and forwards subscription to matching forwarder', function () {
    $subscription = createSubscription(['category' => 'START']);

    $subscriptionFactoryMock = Mockery::mock(SubscriptionFactory::class);
    $subscriptionFactoryMock->shouldReceive('create')
        ->once()
        ->andReturn($subscription);

    $forwarderMock1 = Mockery::mock(GoogleSubscriptionForwarder::class);
    $forwarderMock2 = Mockery::mock(GoogleSubscriptionForwarder::class);

    $forwarderMock1->shouldReceive('supports')
        ->once()
        ->with($subscription)
        ->andReturn(true);

    $forwarderMock1->shouldReceive('forward')
        ->once()
        ->with($subscription);

    $forwarderMock2->shouldReceive('supports')
        ->once()
        ->with($subscription)
        ->andReturn(false);

    $forwarderMock2->shouldNotReceive('forward');
    
    $handler = new GoogleWebhookHandler($subscriptionFactoryMock, [$forwarderMock1, $forwarderMock2]);
    $webhook = new Webhook('google', ['key' => 'value']);
    $handler->handle($webhook);
});