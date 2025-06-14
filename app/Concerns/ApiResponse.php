<?php

namespace App\Concerns;

use App\Constants\HttpCodes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait ApiResponse
{
    /**
     * Returns a JSON response with data
     *
     * @param mixed $data Response data
     * @param int $code HTTP status code
     */
    protected static function responseSuccess(mixed $data = [], int $code = HttpCodes::OK): JsonResponse
    {
        if ($data instanceof JsonResource) {
            return $data->response()->setStatusCode($code);
        }

        return response()->json($data, $code);
    }

    /**
     * Returns a JSON error response
     *
     * @param array $data Response data
     * @param int $code HTTP status code
     */
    protected static function responseError(array $data = [], int $code = HttpCodes::INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json($data, $code);
    }
}
