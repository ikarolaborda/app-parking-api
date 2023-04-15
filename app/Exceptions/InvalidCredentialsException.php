<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidCredentialsException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}
