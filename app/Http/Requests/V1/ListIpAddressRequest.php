<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\V1\BaseIpAddressRequest;

class ListIpAddressRequest extends BaseIpAddressRequest
{
    /**
     * Determine if the user is authorized to make this request
     */
    public function authorize(): bool
    {
        $userIdFilter = $this->input('filter.userId');
        $hasPermissions = $this->hasPermission();

        if ($this->isAdmin() === false && $userIdFilter !== null) {
            return $hasPermissions && $this->getAuthUserId() === $userIdFilter;
        }

        return $hasPermissions;
    }

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
            'sort'    => ['sometimes', 'string'],
            'page'    => ['sometimes', 'string']
        ];
    }
}
