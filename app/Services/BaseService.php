<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Constants\HttpCodes;
use App\Concerns\ApiResponse;

class BaseService {
    use ApiResponse;

    public static function handleException(\Exception $exception, int $code = HttpCodes::INTERNAL_SERVER_ERROR)
    {
        self::logError(error: $exception->getMessage());

        return self::responseError(message: $exception->getMessage(), code: $code);
    }

    private static function logError($error)
    {
        Log::error(message: 'Service Error: ' . $error);
    }
}
