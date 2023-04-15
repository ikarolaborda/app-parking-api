<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{

    public function __construct(protected UserService $userService)
    {
    }

    public function __invoke(UserLoginRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->login($request->validated());
            $device    = substr($request->userAgent() ?? '', 0, 255);
            $expiresAt = $request->remember ? null : now()->addMinutes(config('session.lifetime'));
            return response()->json([
                'access_token' => $user->createToken($device, expiresAt: $expiresAt)->plainTextToken,
            ], Response::HTTP_CREATED);
        } catch (InvalidCredentialsException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 401);
        }

    }
}
