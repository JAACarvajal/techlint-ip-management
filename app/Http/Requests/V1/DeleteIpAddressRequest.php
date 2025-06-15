<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\V1\BaseIpAddressRequest;

class DeleteIpAddressRequest extends BaseIpAddressRequest
{
    /**
     * Required ability for the request
     */
    protected function requiredAbility(): string
    {
        return 'delete:ip_address';
    }

    /**
     * Determine if the user is authorized to make this request
     */
    public function authorize(): bool
    {
        return $this->isAdmin() === true && $this->hasPermission() === true;
    }
}
