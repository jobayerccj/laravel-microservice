<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SubscriptionProviderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubscriptionProvider extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionProviderFactory> */
    use HasFactory;
}
