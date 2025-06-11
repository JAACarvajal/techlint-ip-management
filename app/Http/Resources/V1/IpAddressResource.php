<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IpAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'ip-address',
            'id'   => $this->id,
            'attributes' => [
                'address' => $this->address,
                'label'   => $this->label,
                'comment' => $this->comment,
                $this->mergeWhen(
                    $request->routeIs('ip-addresses.*'),
                    [
                        'created_at' => $this->created_at,
                        'updated_at' => $this->updated_at
                    ]
                ),
            ]
        ];
    }
}
