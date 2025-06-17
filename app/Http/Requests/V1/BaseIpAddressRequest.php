<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Arr;

abstract class BaseIpAddressRequest extends BaseRequest
{
    /**
     * Allowed attributes for the request
     *
     * @var array
     */
    protected array $allowedAttributes = [
        'address',
        'comment',
        'label',
        'user_id',
    ];

    /**
     * Allowed query parameters for the request
     * @var array
     */
    protected array $allowedQueryParams = [
        'sort',
        'filter',
        'include',
    ];

    /**
     * Map the validated attributes to the allowed attributes
     */
    public function mappedAttributes(): array
    {
        $attributes = $this->input('data.attributes');

        return Arr::only($attributes, $this->allowedAttributes);
    }

    /**
     * Map the validated query parameters to the allowed query parameters
     */
    public function mappedQueryParameters(): array
    {
        $queryParams = Arr::only($this->validated(), $this->allowedQueryParams);

        if ($this->isAdmin()) {
            return Arr::only($queryParams, $this->allowedQueryParams);
        }

        return Arr::set($queryParams, 'filter.userId', $this->getAuthUserId());;
    }
}
