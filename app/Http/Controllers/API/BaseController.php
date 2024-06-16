<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * sendResponse
     *
     * @param  mixed $result
     * @param  mixed $message
     * @return JsonResponse
     */
    public function sendResponse($result, $message) : JsonResponse
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $result,
        ];

        return response()->json($response, 200);
    }

        
    /**
     * sendError
     *
     * @param  mixed $error
     * @param  mixed $errorMessages
     * @param  mixed $code
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404) : JsonResponse
    {
        $response = [
            'status' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
