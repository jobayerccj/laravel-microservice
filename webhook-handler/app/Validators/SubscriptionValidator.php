<?php

declare(strict_types=1);

namespace App\Validators;

use App\Exceptions\WebhookException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Validation\Factory;

class SubscriptionValidator
{
    public function __construct(
        private Factory $validatorFactory,
    ) {
    }

    /**
     *
     * @param Arrayable<string, mixed> $subscriptions
     * @param array<string, mixed> $rules
     * @return void
     */
    public function validate(Arrayable $subscriptions, array $rules): void
    {
        $validator = $this->validatorFactory->make(
            $subscriptions->toArray(),
            $rules,
        );

        if ($validator->fails()) {
            throw new WebhookException('Validation failed: Check your webhook payload');
        }
    }
}