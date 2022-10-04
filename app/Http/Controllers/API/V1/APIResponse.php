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
            'message' => $message
        ]);
    }

    public function fail($data = [], $message = null)
    {
        return response()->json([
            'success' => false,
            'errors' => $data,
            'message' => $message
        ]);
    }
}
