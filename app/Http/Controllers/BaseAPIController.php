<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseAPIController extends Controller
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
            'data' => $data,
            'message' => $message
        ]);
    }
}
