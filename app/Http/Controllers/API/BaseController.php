<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller{
    /**
     * success response method.
     * @param $result
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message){
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMesssages = [], $code = 404){
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMesssages)){
            $response['data'] = $errorMesssages;
        }

        return response()->json($response, $code);
    }
}