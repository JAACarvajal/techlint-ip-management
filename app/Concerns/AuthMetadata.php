<?php

namespace App\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait AuthMetadata
{
    /**
     * Get additional metadata for the resource, specifically authentication details
     *
     * @param Request $request Request instance
     */
    public function withAuthMetadata(Request $request): array
    {
        return [
            'auth' => [
                'id' => $request->attributes->get('user_id'),
            ],
        ];
    }
}
