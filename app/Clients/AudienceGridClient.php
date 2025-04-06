<?php

declare(strict_types=1);

namespace App\Clients;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class AudienceGridClient implements AudienceGridClientInterface
{
    private string $apiUrl;

    private function __construct() {
        $this->apiUrl = config('services.audience_grid.api_url');
    }
    

    public function post(array $data): Response
    {
        return Http::post($this->apiUrl, $data);
    }
}