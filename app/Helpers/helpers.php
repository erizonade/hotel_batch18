<?php

if(!function_exists('respons')) {
    function respons($status, $message, $data, $statusCode)
    {
        $response = [
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($response, $statusCode);
    }

}
