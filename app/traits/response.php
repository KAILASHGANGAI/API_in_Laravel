<?php

namespace App\traits\response;

class responseApi
{
    public function success($data, $message, $status = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status
        ]);
    }

    public function failed($data, $message, $status = 201)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status
        ]);
    }
}
