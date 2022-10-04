<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIResponse extends Controller
{
    public function success($data = [], $message = null)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
            'code' => 0
        ]);
    }

    public function fail($data = [], $message = null, $code = 'X000')
    {
        return response()->json([
            'success' => false,
            'code' => $code,
            'errors' => $data,
            'message' => $message,
        ]);
    }
}
