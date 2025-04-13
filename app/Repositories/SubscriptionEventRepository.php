<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\SubscriptionEvent;

class SubscriptionEventRepository
{
    /**
     *
     * @param integer $notificationType
     * @param boolean $inTrial
     * @return SubscriptionEvent
     */
    public function findByNotificationType(int $notificationType, bool $inTrial): SubscriptionEvent
    {
        // Simulate a database lookup
        // In a real application, you would use Eloquent or a query builder to fetch the data
        return SubscriptionEvent::where([
            ['notification_type', '=', $notificationType],
            ['in_trial', '=', $inTrial],
        ])->firstOrFail();
    }
}