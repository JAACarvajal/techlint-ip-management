<?php

namespace App\Repositories;

use App\Models\IpAddress;

class IpAddressRepository extends BaseRepository
{
    /**
     * Create ip address repository instance
     *
     * @param IpAddress $model IP address model instance
     */
    public function __construct(IpAddress $model)
    {
        $this->model = $model;
    }
}
