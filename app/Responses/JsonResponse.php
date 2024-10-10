<?php

namespace App\Responses;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class JsonResponse {
    public static function success(?string $message = null , mixed $data = null)
    {
        return response() -> json(['message' => $message, 'data'=> $data, 'code' => HttpFoundationResponse::HTTP_OK],HttpFoundationResponse::HTTP_OK);
    } 

    public static function error(string $message, int $httpcode)
    {
        return response() -> json(['message'=> $message, 'code'=> $httpcode], $httpcode);
    }
}