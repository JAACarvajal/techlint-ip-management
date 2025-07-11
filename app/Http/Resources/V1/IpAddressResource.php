<?php

namespace App\Http\Resources\V1;

use App\Concerns\AuthMetadata;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IpAddressResource extends JsonResource
{
    use AuthMetadata;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'ip_address',
            'id'   => $this->id,
            'attributes' => [
                'address' => $this->address,
                'label'   => $this->label,
                'comment' => $this->comment,
                'user_id' => $this->user_id,
                $this->mergeWhen(
                    $request->routeIs('ip-addresses.*'),
                    [
                        'created_at' => $this->created_at->toDateTimeString(),
                        'updated_at' => $this->updated_at->toDateTimeString()
                    ]
                ),
            ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param Request $request Request instance
     */
    public function with(Request $request): array
    {
        return [
            'meta' => $this->withAuthMetadata($request),
        ];
    }
}
