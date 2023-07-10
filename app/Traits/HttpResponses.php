<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait HttpResponses{
    protected function successResponse($data, $masseage = null, $code = Response::HTTP_OK){
        return response()->json(['data' => $data, 'message' => $masseage], $code);
    }

    protected function errorResponse($message, $code){
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}