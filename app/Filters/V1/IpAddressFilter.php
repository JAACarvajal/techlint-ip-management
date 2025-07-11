<?php

namespace App\Filters\V1;
use Illuminate\Database\Eloquent\Builder;

class IpAddressFilter extends Filter
{
    /**
     * List of sortable fields
     * @var array
     */
    protected $sortables = [
        'id',
        'address',
        'comment',
        'label',
        'userId' => 'user_id',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at'
    ];

    /**
     * Filter by IP address
     * @param string $value
     */
    public function address($value): Builder
    {
        return $this->builder->where('address', 'like', '%' . $value . '%');
    }

    /**
     * Filter by comment
     * @param string $value
     */
    public function comment($value): Builder
    {
        return $this->builder->where('comment', 'like', '%' . $value . '%');
    }

    /**
     * Filter by created_at date
     * @param string $value
     */
    public function createdAt($value): Builder
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }

    /**
     * Filter by ID
     * @param string $value
     */
    public function id($value): Builder
    {
        return $this->builder->where('id', $value);
    }

    /**
     * Include related models
     * @param string $value
     */
    public function include($value): Builder
    {
        return $this->builder->with($value);
    }

    /**
     * Filter by label
     * @param string $value
     */
    public function label($value): Builder
    {
        return $this->builder->where('label', 'like', '%' . $value . '%');
    }

    /**
     * Filter by updated_at date
     * @param string $value
     */
    public function updatedAt($value): Builder
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates);
        }

        return $this->builder->whereDate('updated_at', $value);
    }

    /**
     * Filter by user id
     * @param string $value
     */
    public function userId($value): Builder
    {
        return $this->builder->where('user_id', $value);
    }
}
