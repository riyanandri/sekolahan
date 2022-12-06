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

function failedResponse($message, $statusCode)
{
    return response()->json([
        'status' => false,
        'message' => $message,
        'data' => null,
        'status_code' => $statusCode,
    ], $statusCode);
}
