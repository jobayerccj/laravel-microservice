<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\Google\Subscription;

interface GoogleSubscriptionForwarder
{
    public function supports(Subscription $subscription): bool;
    public function forward(Subscription $subscription): void;
}
