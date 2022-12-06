<?php

function success($data, $statusCode, $message = 'success')
{
    return response()->json([
        'status' => true,
        'message' => $message,
        'data' => $data,
        'status_code' => $statusCode,
    ], $statusCode);
}
