<?php

namespace App\Webservices;

use Illuminate\Http\Client\Response;

class AuthWebservice extends BaseWebservice
{
    /**
     * Check if the provided token is valid
     */
    public function check(): Response
    {
        return $this->get(
            url: $this->getBaseUrl() . '/api/auth/check',
            headers: $this->getHeaders(),
            token: $this->getToken()
        );
    }

    /**
     * Get the base URL for the authentication service
     */
    public function getBaseUrl(): string
    {
        return env('AUTH_SERVICE_URL');
    }
}
