<?php
namespace App\Traits;

trait ResponseJSON {
    public static function responseJson($data, $message = 'OK', $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
