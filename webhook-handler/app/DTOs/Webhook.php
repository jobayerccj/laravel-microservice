<?php

declare(strict_types=1);

namespace App\DTOs;

readonly class Webhook
{
    /**
     * @param string $platform
     * @param array<string, mixed> $payload
     */
    public function __construct(
        public string $platform,
        public mixed $payload,
    ) {
    }

        /**
         *
         * @return string
         */
        public function getPlatform(): string
        {
            return $this->platform;
        }

        /**
         *
         * @return array<string, mixed>
         */
        public function getPayload()
        {
            return $this->payload;
        }
}
