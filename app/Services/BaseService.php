<?php

namespace App\Services;

use App\Concerns\{AuthMetadata, ApiResponse};


class BaseService
{
    use ApiResponse;
    use AuthMetadata;
}
