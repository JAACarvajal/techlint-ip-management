<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\V1\BaseIpAddressRequest;
use Illuminate\Support\Arr;

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
        $hasPermission = $this->hasPermission();

        if ($this->isAdmin() === true && $hasPermission === true) {
            return true;
        }

        return $hasPermission === true;
    }

    /**
     * Map the validated attributes to the allowed attributes
     */
    public function mappedAttributes(): array
    {
        $attributes = Arr::only($this->input('data.attributes'), $this->allowedAttributes);

        return Arr::set($attributes, 'user_id', $this->getAuthUserId());
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
            'data.attributes.comment' => 'string',
        ];
    }

    /**
     * Override attributes
     */
    public function attributes(): array
    {
        return [
            'data.attributes.address' => 'address',
            'data.attributes.label'   => 'label',
            'data.attributes.comment' => 'comment',
        ];
    }
}
