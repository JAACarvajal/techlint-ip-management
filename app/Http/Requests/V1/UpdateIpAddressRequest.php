<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseRequest;
use App\Models\IpAddress;

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
     * Determine if the user is authorized to make this request
     */
    public function authorize(): bool
    {
        $user = $this->attributes->get('user_attributes');
        $hasPermission = in_array($this->requiredAbility(), $user['permissions']);

        if ($user['is_admin'] === true && $hasPermission) {
            return true;
        }

        $ipAddress = IpAddress::find($this->route('ip_address'));
        $auth_user_id = (int) $this->attributes->get('user_id');

        return
            $ipAddress &&
            $ipAddress->user_id === $auth_user_id &&
            $hasPermission;
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
