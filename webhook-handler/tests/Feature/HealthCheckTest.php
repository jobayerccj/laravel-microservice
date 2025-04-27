<?php

declare(strict_types=1);

use function Pest\Laravel\getJson;

test("the health check endpoint orks", function () {
    $response = getJson('/api/health');

    $response->assertStatus(200);
    $response->assertJson(['status' => 'ok']);
});