<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\V1\BaseIpAddressRequest;

class StoreIpAddressRequest extends BaseIpAddressRequest
{
    /**
     * Required ability for the request
     */
    protected function requiredAbility(): string
    {
        return 'create:ip_address';
    }

    /**
     * Determine if the user is authorized to make this request
     */
    public function authorize(): bool
    {
        if ($this->isAdmin() === true && $this->hasPermission() === true) {
            return true;
        }

        return
            $this->hasPermission() === true &&
            $this->input('data.attributes.user_id') == $this->getAuthUserId();
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
            'data.attributes.user_id' => 'required|string',
            'data.attributes.comment' => 'string',
        ];
    }

    /**
     * Messages for validation rules
     */
    public function messages(): array
    {
        return [
            'data.attributes.user_id.required' => 'The data.attributes.user_id field is required.',
        ];
    }
}
