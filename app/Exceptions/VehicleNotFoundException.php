<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class VehicleNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => 'Vehicle not found with the given parameters'
        ], 404);
    }
}
