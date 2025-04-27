<?php

declare(strict_types=1);

namespace App\Error;

use Throwable;

class DebugErrorHandler implements \App\Contracts\ErrorHandler
{
    public function handle(Throwable $throwable): void
    {
        throw $throwable;
    }
}