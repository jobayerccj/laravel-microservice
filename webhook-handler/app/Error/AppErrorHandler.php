<?php

declare(strict_types=1);

namespace App\Error;

use Log;
use Throwable;

class AppErrorHandler extends DebugErrorHandler
{
    public function handle(Throwable $throwable): void
    {
        Log::error('An error occurred', [
            'message' => $throwable->getMessage(),
            'trace' => $throwable->getTraceAsString(),
            'file' => $throwable->getFile(),
            'line' => $throwable->getLine(),
        ]);
    }
}