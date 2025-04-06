<?php

declare(strict_types=1);

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::get('/health', function (): JsonResponse {
    return response()->json(['status' => 'ok']);
})->name('api.health');

Route::post('/webhook', WebhookController::class);
