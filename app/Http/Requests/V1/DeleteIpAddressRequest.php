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
        $user = $this->attributes->get('user_attributes');
        $hasPermission = in_array($this->requiredAbility(), $user['permissions']);

        return $user['is_admin'] === true && $hasPermission;
    }
}
