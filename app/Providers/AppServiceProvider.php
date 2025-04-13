<?php

namespace App\Providers;

use App\DTOs\Webhook;
use App\Contracts\WebhookHandler;
use App\Handlers\HandlerDeligator;
use App\Handlers\AppleWebhookHandler;
use App\Handlers\GoogleWebhookHandler;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->tag([
            GoogleWebhookHandler::class,
            AppleWebhookHandler::class,
        ], WebhookHandler::class);
        
        $this->app->bind(HandlerDeligator::class, function (Application $app) {
            return new HandlerDeligator($app->tagged(WebhookHandler::class));
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
