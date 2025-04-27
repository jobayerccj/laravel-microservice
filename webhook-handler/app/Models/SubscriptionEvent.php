<?php

namespace App\Models;

use App\DTOs\SubscriptionEventCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $subscription_provider_id
 * @property string $name
 * @property SubscriptionEventCategory $category
 * @property int $notification_type
 * @property bool $in_trial
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SubscriptionProvider $subscriptionProvider
 * @method static \Database\Factories\SubscriptionEventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereInTrial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereNotificationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereSubscriptionProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubscriptionEvent extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionEventFactory> */
    use HasFactory;

    protected $fillable = [
        'subscription_provider_id',
        'name',
        'category',
        'notification_type',
        'in_trial',
    ];

    protected $casts = [
        'in_trial' => 'boolean',
        'category' => SubscriptionEventCategory::class,
    ];

    /**
     * @phpstan-ignore missingType.generics
     */
    public function subscriptionProvider(): BelongsTo
    {
        return $this->belongsTo(SubscriptionProvider::class);
    }
}
