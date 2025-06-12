<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseRequest;

class DeleteIpAddressRequest extends BaseRequest
{
    /**
     * Required ability for the request
     */
    protected function requiredAbility(): string
    {
        return 'delete:ip_address';
    }
}
