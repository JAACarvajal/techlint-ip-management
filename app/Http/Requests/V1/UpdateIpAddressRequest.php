<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseRequest;

class UpdateIpAddressRequest extends BaseRequest
{
    /**
     * Required ability for the request
     */
    protected function requiredAbility(): string
    {
        return 'update:ip_address';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.attributes.address' => 'required|string',
            'data.attributes.label'   => 'required|string',
            'data.attributes.comment' => 'string'
        ];
    }
}
