<?php

declare(strict_types=1);

namespace App\Clients;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class AudienceGridClient implements AudienceGridClientInterface
{
    private string $apiUrl;

    public function __construct()
    {
        /** @phpstan-ignore assign.propertyType */
        $this->apiUrl = config('services.audiencegrid.api_url') ;
    }
    
    public function post(array $data): Response
    {
        Log::info('AudienceGridClient post method called', [
            'api_url' => $this->apiUrl,
            'data' => $data,
        ]);
        
        return Http::post($this->apiUrl, $data);
    }
}