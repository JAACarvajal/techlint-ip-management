<?php

namespace App\Http\Requests;

use App\Concerns\ApiResponse;
use App\Constants\HttpCodes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedAuthorization(): never
    {
        throw new HttpResponseException(
            self::responseError('Unauthorized', HttpCodes::FORBIDDEN),
        );
    }
}
