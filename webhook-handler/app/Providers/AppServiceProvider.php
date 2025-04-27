<?php

namespace App\Providers;

use App\DTOs\Webhook;
use App\Error\AppErrorHandler;
use App\Error\DebugErrorHandler;
use App\Contracts\WebhookHandler;
use App\Handlers\HandlerDeligator;
use App\Handlers\AppleWebhookHandler;
use App\Handlers\GoogleWebhookHandler;
use Illuminate\Support\ServiceProvider;
use App\DTOs\Google\SubscriptionFactory;
use App\Contracts\GoogleSubscriptionForwarder;
use Illuminate\Contracts\Foundation\Application;
use App\Forwarders\Google\SubscriptionStartForwarder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->tag([
            SubscriptionStartForwarder::class,
        ], GoogleSubscriptionForwarder::class);

        $this->app->bind(GoogleWebhookHandler::class, function (Application $app) {
            return new GoogleWebhookHandler(
                $app->make(SubscriptionFactory::class),
                $app->tagged(GoogleSubscriptionForwarder::class),
            );
        });

        $this->app->tag([
            GoogleWebhookHandler::class,
            AppleWebhookHandler::class,
        ], WebhookHandler::class);
        
        $this->app->bind(HandlerDeligator::class, function (Application $app) {
            return new HandlerDeligator($app->tagged(WebhookHandler::class));
        });

        $this->app->bind('App\Contracts\ErrorHandler', function (Application $app) {
            if ($app->environment('production')) {
                return new AppErrorHandler();
            }

            return new DebugErrorHandler();
        });
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
