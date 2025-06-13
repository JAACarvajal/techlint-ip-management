<?php

namespace App\Http\Requests;

use App\Concerns\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    use ApiResponse;

    /**
     * Get the validation rules that apply to the request.
     */
    abstract protected function requiredAbility(): string;

    /**
     * Determine if the user is authorized to make this request
     */
    public function authorize(): bool
    {
        $permissions = $this->attributes->get('user_attributes')['permissions'] ?? [];

        return in_array($this->requiredAbility(), $permissions);
    }

    /**
     * Handle a failed authorization attempt
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization(): never
    {
        throw new AuthorizationException('This action is unauthorized.');
    }
}
