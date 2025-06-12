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

    public function authorize(): bool
    {
        $permissions = $this->attributes->get('permissions', []);
        return in_array($this->requiredAbility(), $permissions);
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            self::responseError('You do not have permission to perform this action.', HttpCodes::FORBIDDEN),
        );
    }
}
