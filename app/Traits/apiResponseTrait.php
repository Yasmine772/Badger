<?php

namespace App\Traits;

trait apiResponseTrait
{
    public function successResponse($data, $message = 'Success', $code)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code
        ], 200);
    }

    public function ErrorResponse($data, $code)
    {
        return response()->json([
            'error' => $data,
            'code' => $code
        ], 500);
    }
}
