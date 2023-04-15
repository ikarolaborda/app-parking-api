<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(protected UserService $userRegisterService)
    {
    }

    public function __invoke(UserRegisterRequest $request): JsonResponse
    {
        $user = $this->userRegisterService->register($request->validated());
        event(new Registered($user));

        $device = substr($request->userAgent() ?? '', 0, 255);

        return response()->json([
            'access_token' => $user->createToken($device)->plainTextToken,
        ], Response::HTTP_CREATED);
    }
}
