<?php

namespace App\Webservices;

class AuthWebservice extends BaseWebservice
{
    /**
     * Check if the provided token is valid
     *
     * @param string $token JWT token to check
     */
    public function check(string $token)
    {
        return $this->get($this->getBaseUrl() . '/api/auth/check', $this->getHeaders(), $token);
    }

    /**
     * Get the base URL for the authentication service
     */
    public function getBaseUrl(): string
    {
        return env('AUTH_SERVICE_URL');
    }
}
