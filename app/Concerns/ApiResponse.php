<?php

namespace App\Concerns;

use App\Constants\HttpCodes;

trait ApiResponse
{
    protected static function responseWithMessage($data = [], string $message = 'success', int $code = HttpCodes::OK)
    {
        return self::responseSuccess([
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    protected static function responseSuccess( $data = [], int $code = HttpCodes::OK)
    {
        return response()->json(['data' => $data], $code);
    }

    protected static function responseError(string $message = 'Something went wrong', int $code = HttpCodes::INTERNAL_SERVER_ERROR)
    {
        return response()->json(['error' => $message], $code);
    }
}
