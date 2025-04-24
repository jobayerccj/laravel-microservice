<?php

declare(strict_types=1);

namespace Tests\Unit\Validators;

use Illuminate\Validation\Factory;
use App\Exceptions\WebhookException;
use Illuminate\Translation\Translator;
use Illuminate\Translation\ArrayLoader;
use App\Validators\SubscriptionValidator;
use Illuminate\Contracts\Support\Arrayable;

beforeEach(function () {
    $translator = new Translator(
        new ArrayLoader(),
        'en',
    );

    $this->factory = new Factory($translator);
});

it('will not throw any excetion for proper data', function () {
    $validator = new SubscriptionValidator(
        $this->factory
    );

    $subscription = new class implements Arrayable {

        public function toArray(): array
        {
            return [
                'event' => 'subscription_started',
                'properties' => [
                    'subscription_id' => 'premium_monthly',
                    'platform' => 'Google Android',
                    'auto_renew_status' => true,
                    'currency' => 'USD',
                    'in_trial' => false,
                    'product_name' => 'premium_monthly',
                    'renewal_date' => '2024-02-10T12:24:50+00:00',
                    'start_date' => '2024-01-06T19:04:50+00:00',
                ],
                'user' => [
                    'id' => 'USER-001',
                    'email' => 'joe@example.com',
                    'region' => 'US',
                ],
            ];
        }

        public static function rules(): array
        {
            return [
                'event' => 'required|string',
                'properties.subscription_id' => 'required|string',
                'properties.platform' => 'required|string',
                'properties.auto_renew_status' => 'required|boolean',
                'properties.currency' => 'required|string|size:3',
                'properties.in_trial' => 'required|boolean',
                'properties.product_name' => 'required|string',
                'properties.renewal_date' => 'required|date|after_or_equal:properties.start_date',
                'properties.start_date' => 'required|date',
                'user.id' => 'required|string',
                'user.email' => 'required|email',
                'user.region' => 'required|string|size:2',
            ];
        }
    };

    $validator->validate(
        $subscription,
        $subscription::rules(),
    );

    expect(true)->toBeTrue();
});

it('will throw any excetion for wrong data', function () {
    $validator = new SubscriptionValidator(
        $this->factory
    );

    $subscription = new class implements Arrayable {

        public function toArray(): array
        {
            return [];
        }

        public static function rules(): array
        {
            return [
                'event' => 'required|string',
                'properties.subscription_id' => 'required|string'
            ];
        }
    };

    expect(fn () => $validator->validate($subscription,$subscription::rules()))
        ->toThrow(\App\Exceptions\WebhookException::class, 'Validation failed: Check your webhook payload')
    ;
});