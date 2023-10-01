<?php

namespace App\Helpers;

class ResponseHelper{

    public static function success($message , $responseCode , $data = [])
    {
        return response()->json([
            'status' => 'success',
            'statusCode' => 1,
            'message' => $message,
            'data' => $data
        ],$responseCode);
    }

    public static function error($message , $responseCode , $data = [])
    {
        return response()->json([
            'status' => 'error',
            'statusCode' => 0,
            'message' => $message,
            'data' => $data
        ],$responseCode);
    }
}
