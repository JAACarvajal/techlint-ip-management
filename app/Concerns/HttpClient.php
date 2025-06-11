<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

trait HttpClient
{
    /**
     * GET request to the specified URL with optional headers
     *
     * @param string $url URL to send the GET request to
     * @param array $headers Optional headers to include in the request
     * @param string $token JWT token for authentication
     */
    public function get(string $url, array $headers = [], string $token): Response
    {
        return Http::withHeaders($headers)->withToken($token)->get($url);
    }
}
