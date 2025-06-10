<?php

namespace App\Repositories;

use App\Models\IpAddress;

/**
 * Summary of IpAddressRepository
 */
class IpAddressRepository extends BaseRepository
{
    public function __construct(IpAddress $model)
    {
        $this->model = $model;
    }
}
