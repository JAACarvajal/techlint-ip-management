<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseRequest;

class StoreIpAddressRequest extends BaseRequest
{
    /**
     * Required ability for the request
     */
    protected function requiredAbility(): string
    {
        return 'create:ip_address';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.attributes.address' => 'required|string|ip',
            'data.attributes.label'   => 'required|string',
            'data.attributes.user_id' => 'required|integer',
            'data.attributes.comment' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'data.attributes.user_id.required' => 'The data.attributes.user_id field is required.',
        ];
    }
}
