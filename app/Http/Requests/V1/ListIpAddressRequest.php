<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\V1\BaseIpAddressRequest;

class ListIpAddressRequest extends BaseIpAddressRequest
{
    /**
     * Required ability for the request
     */
    protected function requiredAbility(): string
    {
        return 'view:ip_address';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'include' => ['sometimes'],
            'filter'  => ['sometimes', 'array'],
            'sort'    => ['sometimes', 'string']
        ];
    }
}
