<?php

namespace App\Repositories;

use App\Models\IpAddress;

class IpAddressRepository extends BaseRepository
{
    public function __construct(IpAddress $model)
    {
        $this->model = $model;
    }
}
