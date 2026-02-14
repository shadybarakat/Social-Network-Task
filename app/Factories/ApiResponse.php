<?php

namespace App\Factories;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(
        mixed $data = null,
        string $message = 'Success',
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    public static function created(
        mixed $data = null,
        string $message = 'Created'
    ): JsonResponse {
        return self::success($data, $message, 201);
    }
}
