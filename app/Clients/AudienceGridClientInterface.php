<?php

declare(strict_types=1);

namespace App\Clients;

use Illuminate\Http\Client\Response;



interface AudienceGridClientInterface
{
    /**
     *
     * @param array<string, mixed> $data
     * @return Response
     */
    public function post(array $data): Response;
}
