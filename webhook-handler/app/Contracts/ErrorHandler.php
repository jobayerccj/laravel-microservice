<?php

declare(strict_types=1);

namespace App\Contracts;

use Throwable;

interface ErrorHandler
{
    public function handle(Throwable $exception): void;
}